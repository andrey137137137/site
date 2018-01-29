<?php

namespace yii\helpers;

class Inflector extends BaseInflector
{
  public static $transliterator = 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;';
}