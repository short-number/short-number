<?php

declare(strict_types=1);

namespace Serhii\Tests;

use LogicException;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;
use Serhii\ShortNumber\Config;
use Serhii\ShortNumber\Lang;
use Serhii\ShortNumber\Number;

final class NumberConfigureOnceTest extends TestCase
{
    #[RunInSeparateProcess]
    public function testConfigureCanBeCalledMultipleTimes(): void
    {
        Number::configure(new Config(decimals: 1));
        Number::configure(new Config(decimals: 2));

        $this->assertSame('5.93m', Number::short(5_935_235));
    }

    #[RunInSeparateProcess]
    public function testConfigureOnceAppliesConfiguration(): void
    {
        Number::configureOnce(new Config(decimals: 1));
        $this->assertSame('5.9m', Number::short(5_935_235));
    }

    #[RunInSeparateProcess]
    public function testConfigureOnceCanOverwriteConfigurationSetByConfigure(): void
    {
        Number::configure(new Config(decimals: 1));
        Number::configureOnce(new Config(decimals: 2));

        $this->assertSame('5.93m', Number::short(5_935_235));
    }

    #[RunInSeparateProcess]
    public function testConfigureThrowsAfterConfigureOnce(): void
    {
        Number::configureOnce(new Config(decimals: 1));

        $this->expectException(LogicException::class);
        Number::configure(new Config(decimals: 2));
    }

    #[RunInSeparateProcess]
    public function testConfigureOnceThrowsWhenCalledAgain(): void
    {
        Number::configureOnce(new Config(decimals: 1));

        $this->expectException(LogicException::class);
        Number::configureOnce(new Config(decimals: 2));
    }

    #[RunInSeparateProcess]
    public function testLanguageCanStillBeChangedAfterConfigureOnce(): void
    {
        Number::configureOnce(new Config(decimals: 1));

        Lang::set('ru');

        $this->assertSame('5.9млн', Number::short(5_935_235));
    }

}
