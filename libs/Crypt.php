<?php
class Crypt
{    
    public function caeasar_encrypt($plaintext, $offset = 3)
    {
        $plaintext = $chipertext = str_split($plaintext);
        $n = sizeof($plaintext);
        
        for($i=0; $i<$n; $i++)
        {
            $ascii = ord($plaintext[$i]);
            if($ascii == 32)
            {
                $chipertext[$i] = chr($ascii);
                continue;
            }
            
            for($j=0; $j<$offset; $j++)
            {
                $ascii++;
                if($ascii == 91) $ascii = 65;
                if($ascii == 123) $ascii = 97;
            }
            $chipertext[$i] = chr($ascii);
        }
        
        return implode('', $chipertext);
    }
    
    public static function caesar_decrypt($chipertext, $offset = 3)
    {
        $plaintext = $chipertext = str_split($chipertext);
        $n = sizeof($chipertext);
        
        for($i=0; $i<$n; $i++)
        {
            $ascii = ord($chipertext[$i]);
            if($ascii == 32)
            {
                $plaintext[$i] = chr($ascii);
                continue;
            }

            for($j=0; $j<$offset; $j++)
            {
                $ascii--;
                if($ascii == 64) $ascii = 90;
                if($ascii == 96) $ascii = 122;
            }
            $plaintext[$i] = chr($ascii);
        }
        
        return implode('', $plaintext);
    }
    
    // vigeniere for the letters A-Z is defined as: 
    //      vigeniere(m) = m[i] + k[i] % 26
    // where m is the message to encrypt and k is the key to use.
    public function vigeniere_encrypt($plaintext, $key)
    {
        $plaintext = $chiphertext = str_split($plaintext);
        $n = sizeof($plaintext);
        $key = str_split($key);
        $m = sizeof($key);
        
        for($i=0; $i<$n; $i++)
        {
            $p = ord($plaintext[$i]) - 32;
            $k = ord($key[$i % $m]) - 32;

            $sum = ($p+$k) % 26 + 64;
            
            $chiphertext[$i] = chr($sum);
        }
        
        return implode('', $chiphertext);
    }
    
    public function vigeniere_decrypt($chipertext, $key)
    {
        $chipertext = $plaintext = str_split($chipertext);
        $n = sizeof($chipertext);
        $key = str_split($key);
        $m = sizeof($key);
        
        for($i=0; $i<$n; $i++)
        {
            $c = ord($chipertext[$i]) - 32;
            $k = ord($key[$i % $m]) - 32;
            
            $sum = ($c - $k) % 26 + 64;
            $plaintext[$i] = chr($sum);
        }
        
        return implode('', $plaintext);
    }
}
?>

