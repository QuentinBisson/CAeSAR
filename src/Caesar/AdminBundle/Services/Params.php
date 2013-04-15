<?php
namespace Caesar\AdminBundle\Services;

use InvalidArgumentException;
use Symfony\Component\Yaml\Yaml;

class Params
{
    private $file;
    private $old_params = array();

    public function __construct($filename){
        $this->file = __DIR__.'/../Resources/config/'.$filename;
        $this->old_params = $this->read();
    }
    
    // Cette méthode nous transforme un array en syntaxe YML
    private function render($params){
        return Yaml::dump(array('parameters' => $params));
    }

    // Cette méthode nous permet de récupérer
    // les variables présentent dans le fichier
    // Et de nous les retourner sous forme de array 

    private function read(){
        $old_params = Yaml::parse($this->file);
        if($old_params === false || $old_params === array())
            throw new InvalidArgumentException('File error ! ('.$this->file.')');
        if(isset($old_params['parameters']) && is_array($old_params['parameters']))
            return $old_params['parameters'];
        else
            return array();
    }

    // Cette méthode nous permet de fusionner
    // les anciennes variables avec les nouvelles

    private function merge($params){
        if(is_array($params))
            return $params = array_merge($this->old_params, $params);
        else
            return $this->old_params;
    }
    
    // Cette méthode est la plus importante
    // car c'est elle qui va être appelée par
    // le controller pour inscrire les informations
    // dans notre fichier params

    public function save($params){
        $persist_params = $this->merge($params);
        return file_put_contents($this->file, $this->render($persist_params));
    }
}