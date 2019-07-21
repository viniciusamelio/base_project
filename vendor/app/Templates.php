<?php
namespace App;

use Rain\Tpl;

class Templates
{
    #Atributo que recebe o objeto do RainTPL
    private $template;
    #Array de opções
    private $options = [];
    #Array de Opções padrões
    private $default = [
        "header"=>true,
        "footer"=>true,
        "data" => []
    ];

    public function __construct($options = array(), $template_directory = "/View/")
    {
        #É feita uma mesclagem do array de opções e o de padrões
        $this->options = array_merge($this->default,$options);

        #São setados os paths para os templates e seus caches
        $config = array(
            "tpl_dir"       => $_SERVER['DOCUMENT_ROOT'].$template_directory,
            "cache_dir"     => $_SERVER['DOCUMENT_ROOT']."/View_Cache/"
           );

        #Configurando o RainTPL
        Tpl::configure( $config );


        #Instância do Rain
        $this->template = new Tpl;

        #Setando as opções passadas
        $this->setOptions($options);

        #Chamando o Header
        if($this->options['header'] == true)
        {
            $this->template->draw("Header");
        }

    }

    #Função para dar assign nas variáveis passadas
    public function setOptions($data = array())
    {
        foreach($data as $key => $value ){

            $this->template->assign($key,$value);

        }
    }

    #Função para chamar o template
    public function setTemplate($template,$data = array(), $returnHTML = false)
    {
        $this->setOptions($data);

        return $this->template->draw($template,$returnHTML);

    }

    public function __destruct()
    {
        #Chamando footer
        if($this->options['footer'] == true)
        {
            $this->template->draw("Footer");
        }
    }

}
