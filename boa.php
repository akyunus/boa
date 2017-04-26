<?php

Class BOA {
    
    private static function get_header_bits($var, $bc) {
        $bits = $var >> (8 - $bc);
        return $bits;
    }
    // $array 8bitlik 32 elemanlı dizi = 128 bitlik veri dizisi
    private static function shift_left_128($array, $shift_count) {
        $rslt        = array();
        $shift_count = $shift_count % 8;
        $acnt        = count($array);
        for ($i = 0; $i < $acnt; $i++) {
            if ($i == 0) {
                $first_header_bits = self::get_header_bits($array[$i], $shift_count);
            }
            if ($i == ($acnt - 1)) {
                $next_header_bits = $first_header_bits;
            } else {
                $next_header_bits = self::get_header_bits($array[$i + 1], $shift_count);
            }
            $shifted  = $array[$i] << $shift_count;
            $shifted  = $shifted + $next_header_bits;
            $shifted  = $shifted % 256;
            $rslt[$i] = $shifted;
        }
        return $rslt;
    }
    
    private static function printHex($arr) {
        $str = "";
        $cnt = count($arr);
        
        for ($i = 0; $i < 16; $i++) {
            $n = $arr[$i];
            
            $hex2 = ($n < 16 ? '0' . dechex($n) : dechex($n));
            
            $str .= $hex2;
        }
        return $str;
        
    }
    
    private static function xorfunc($A, $in) {
        
        $rslt = array();
        $cnt  = count($A);
        for ($i = 0; $i < $cnt; $i++) {
            $fbit     = $A[$i];
            $lbit     = $fbit ^ $in;
            $rslt[$i] = $lbit;
        }
        return $rslt;
    }
    
    
    
    public static function hash($input) {
        
        // başlangıç değeri.
        $OUT   = array(
            0x71,
            0x8B,
            0xCD,
            0x58,
            0x82,
            0x15,
            0x4A,
            0xEE,
            0x7B,
            0x54,
            0xA4,
            0x1D,
            0xC2,
            0x5A,
            0x59,
            0xB5
        );
		
        $value = unpack('H*', $input);
        
        $input_Array = str_split($value[1], 2);
        
        
        for ($i = 0; $i < count($input_Array); $i++) {
            
            $x = hexdec($input_Array[$i]);
            
            $m = $x % 4;
            
            $OUT = self::shift_left_128($OUT, 2 * $m + 1);
            $OUT = self::xorfunc($OUT, $x);
            $OUT = self::shift_left_128($OUT, 2 * $m );
            $OUT = self::xorfunc($OUT, $x);
            $OUT = self::shift_left_128($OUT, 5);
            $OUT = self::xorfunc($OUT, $x);
            $OUT = self::shift_left_128($OUT, 3 );
            $OUT = self::xorfunc($OUT, $x);
			$OUT = self::shift_left_128($OUT, 7 );
            $OUT = self::xorfunc($OUT, $x);
            
        }
        
        return self::printHex($OUT);
    }
}
