<?php declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Serhii\ShortNumber\Conv;

class ConvTest extends TestCase
{
    /**
     * @param int $from
     * @param int $until
     * @param int $add
     * @param int $divide
     * @return array
     */
    private function generateDataForProvider(int $from, int $until, int $add, int $divide)
    {
        $data = [];

        for ($i = $from; $i < $until; $i += $add) {
            $data[$i] = [$i, number_format(floatval($i / $divide))];
        }

        return $data;
    }

    /**
     * @dataProvider Provider_for_returns_correct_number_between_0_and_899
     * @test
     * @param int $number
     */
    public function returns_correct_number_between_0_and_899(int $number): void
    {
        $this->assertEquals($number, Conv::short($number));
    }

    public function Provider_for_returns_correct_number_between_0_and_899(): array
    {
        $data = [];

        for ($i = 0; $i < 899; $i++) {
            $data[$i] = [$i];
        }

        return $data;
    }

    /**
     * @dataProvider Provider_for_returns_correct_number_between_899_and_899999
     * @test
     * @param int $num_before
     * @param int $num_after
     */
    public function returns_correct_number_between_899_and_899999(int $num_before, int $num_after): void
    {
        $failed_message = "Failed on test #$num_before";
        $this->assertEquals("{$num_after}K", Conv::short($num_before), $failed_message);
    }

    public function Provider_for_returns_correct_number_between_899_and_899999(): array
    {
        return $this->generateDataForProvider(900, 899999, 1000, 1000);
    }

    /**
     * @dataProvider Provider_for_returns_correct_number_between_899999_and_899999999
     * @test
     * @param int $num_before
     * @param int $num_after
     */
    public function returns_correct_number_between_899999_and_899999999(int $num_before, int $num_after): void
    {
        $failed_message = "Failed on test #$num_before";
        $this->assertEquals("{$num_after}M", Conv::short($num_before), $failed_message);
    }

    public function Provider_for_returns_correct_number_between_899999_and_899999999(): array
    {
        return $this->generateDataForProvider(900000, 899999999, 1000000, 1000000);
    }

    /**
     * @dataProvider Provider_for_returns_correct_number_above_899999999
     * @test
     * @param int $num_before
     * @param int $num_after
     */
    public function returns_correct_number_above_899999999(int $num_before, int $num_after): void
    {
        $failed_message = "Failed on test #$num_before";
        $this->assertEquals("{$num_after}B", Conv::short($num_before), $failed_message);
    }

    public function Provider_for_returns_correct_number_above_899999999(): array
    {
        return $this->generateDataForProvider(900000000, 100000000000, 100000000, 1000000000);
    }
}