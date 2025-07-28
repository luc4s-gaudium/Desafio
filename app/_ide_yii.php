<?php

class Yii
{
    /**
     * Cria e retorna a aplicação web (stub).
     * @param string $config arquivo de configuração
     * @return CWebApplication
     */
    public static function createWebApplication($config)
    {
        // Só para a IDE não reclamar, sem implementação real aqui
        return new CWebApplication();
    }

    /**
     * Retorna a aplicação atual (stub).
     * @return CWebApplication
     */
    public static function app()
    {
        return new CWebApplication();
    }
}

class CWebApplication
{
    /**
     * Executa a aplicação (stub).
     */
    public function run()
    {
        // Sem implementação, só para a IDE
    }
}


class CComponent {}

class CHtml extends CComponent
{
    /**
     * Método estático encode para evitar erro no Intelephense.
     * @param string $text
     * @return string
     */
    public static function encode($text) {}
}

class CModel {}

class CActiveRecord extends CModel {}

class CBaseController {}

class CController extends CBaseController {}
