<?php


namespace App;


class Helper
{
    /*
     * Эта штука нужна чтобы смотреть объекты и методы за фасадами или в том-же КриптоПро плагине
     * Просто делаешь Parse($object) и он покажет какие есть свойства и методы в классе этого объекта
     * Вот ПРИМЕР:
     * Helper::Parse(new \CPSignedData())
     *
     * ===
<pre>CLASS NAME = CPSignedData<br /><br /><br />Method [ <internal:php_CPCSP, ctor> public method __construct ] {
}
<br />Method [ <internal:php_CPCSP> public method SignCades ] {
}
<br />Method [ <internal:php_CPCSP> public method SignHash ] {
}
<br />Method [ <internal:php_CPCSP> public method Sign ] {
}
<br />Method [ <internal:php_CPCSP> public method CoSign ] {
}
<br />Method [ <internal:php_CPCSP> public method CoSignCades ] {
}
<br />Method [ <internal:php_CPCSP> public method CoSignHash ] {
}
<br />Method [ <internal:php_CPCSP> public method EnhanceCades ] {
}
<br />Method [ <internal:php_CPCSP> public method VerifyCades ] {
}
<br />Method [ <internal:php_CPCSP> public method VerifyHash ] {
}
<br />Method [ <internal:php_CPCSP> public method Verify ] {
}
<br />Method [ <internal:php_CPCSP> public method set_ContentEncoding ] {
}
<br />Method [ <internal:php_CPCSP> public method get_ContentEncoding ] {
}
<br />Method [ <internal:php_CPCSP> public method set_Content ] {
}
<br />Method [ <internal:php_CPCSP> public method get_Content ] {
}
<br />Method [ <internal:php_CPCSP> public method get_Signers ] {
}
<br />Method [ <internal:php_CPCSP> public method get_Certificates ] {
}
<br /></pre>
     */
    public static function Parse($object)
    {
        if (!is_object($object)) {
            throw new Exception("This is not a Object");
            return;
        }
        if (class_exists(get_class($object), true)) {
            echo "<pre>CLASS NAME = " . get_class($object);
        }
        $reflection = new \ReflectionClass(get_class($object));
        echo "<br />";
        echo $reflection->getDocComment();

        echo "<br />";

        $metody = $reflection->getMethods();
        foreach ($metody as $key => $value) {
            echo "<br />" . $value;
        }

        echo "<br />";

        $vars = $reflection->getProperties();
        foreach ($vars as $key => $value) {
            echo "<br />" . $value;
        }
        echo "</pre>";
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}