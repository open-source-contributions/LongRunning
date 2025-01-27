<?php

namespace LongRunning\Sentry\Cleaner;

use PHPUnit\Framework\TestCase;
use Psr\Log\Test\TestLogger;
use Sentry\ClientInterface;

final class FlushSentryErrorsTest extends TestCase
{
    /**
     * @test
     */
    public function it_test_if_handlers_get_cleared(): void
    {
        $logger = new TestLogger();

        $sentry = $this
            ->getMockBuilder(ClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $sentry
            ->expects($this->once())
            ->method('flush');

        $cleaner = new FlushSentryErrors($sentry, $logger);
        $cleaner->cleanUp();

        $this->assertTrue($logger->hasDebug('Flush sentry errors'));
    }
}
