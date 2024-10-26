<?php

namespace sneakypanel\Tests\Integration\Services\Backups;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use sneakypanel\Models\Backup;
use GuzzleHttp\Exception\ClientException;
use sneakypanel\Extensions\Backups\BackupManager;
use sneakypanel\Extensions\Filesystem\S3Filesystem;
use sneakypanel\Services\Backups\DeleteBackupService;
use sneakypanel\Tests\Integration\IntegrationTestCase;
use sneakypanel\Repositories\Wings\DaemonBackupRepository;
use sneakypanel\Exceptions\Service\Backup\BackupLockedException;
use sneakypanel\Exceptions\Http\Connection\DaemonConnectionException;

class DeleteBackupServiceTest extends IntegrationTestCase
{
    public function testLockedBackupCannotBeDeleted()
    {
        $server = $this->createServerModel();
        $backup = Backup::factory()->create([
            'server_id' => $server->id,
            'is_locked' => true,
        ]);

        $this->expectException(BackupLockedException::class);

        $this->app->make(DeleteBackupService::class)->handle($backup);
    }

    public function testFailedBackupThatIsLockedCanBeDeleted()
    {
        $server = $this->createServerModel();
        $backup = Backup::factory()->create([
            'server_id' => $server->id,
            'is_locked' => true,
            'is_successful' => false,
        ]);

        $mock = $this->mock(DaemonBackupRepository::class);
        $mock->expects('setServer->delete')->with($backup)->andReturn(new Response());

        $this->app->make(DeleteBackupService::class)->handle($backup);

        $backup->refresh();

        $this->assertNotNull($backup->deleted_at);
    }

    public function testExceptionThrownDueToMissingBackupIsIgnored()
    {
        $server = $this->createServerModel();
        $backup = Backup::factory()->create(['server_id' => $server->id]);

        $mock = $this->mock(DaemonBackupRepository::class);
        $mock->expects('setServer->delete')->with($backup)->andThrow(
            new DaemonConnectionException(
                new ClientException('', new Request('DELETE', '/'), new Response(404))
            )
        );

        $this->app->make(DeleteBackupService::class)->handle($backup);

        $backup->refresh();

        $this->assertNotNull($backup->deleted_at);
    }

    public function testExceptionIsThrownIfNot404()
    {
        $server = $this->createServerModel();
        $backup = Backup::factory()->create(['server_id' => $server->id]);

        $mock = $this->mock(DaemonBackupRepository::class);
        $mock->expects('setServer->delete')->with($backup)->andThrow(
            new DaemonConnectionException(
                new ClientException('', new Request('DELETE', '/'), new Response(500))
            )
        );

        $this->expectException(DaemonConnectionException::class);

        $this->app->make(DeleteBackupService::class)->handle($backup);

        $backup->refresh();

        $this->assertNull($backup->deleted_at);
    }

    public function testS3ObjectCanBeDeleted()
    {
        $server = $this->createServerModel();
        $backup = Backup::factory()->create([
            'disk' => Backup::ADAPTER_AWS_S3,
            'server_id' => $server->id,
        ]);

        $manager = $this->mock(BackupManager::class);
        $adapter = $this->mock(S3Filesystem::class);

        $manager->expects('adapter')->with(Backup::ADAPTER_AWS_S3)->andReturn($adapter);

        $adapter->expects('getBucket')->andReturn('foobar');
        $adapter->expects('getClient->deleteObject')->with([
            'Bucket' => 'foobar',
            'Key' => sprintf('%s/%s.tar.gz', $server->uuid, $backup->uuid),
        ]);

        $this->app->make(DeleteBackupService::class)->handle($backup);

        $this->assertSoftDeleted($backup);
    }
}
