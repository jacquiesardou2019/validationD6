<?php


namespace classes;


class Druid extends Character
{
    private  $nature = 0;
    private $heal = false;

    public function attack(Character $target) {
        $rand = rand(1,10);
        if ($rand == 1) {
            $status = $this->heal();
        } else if ($rand >1 && $rand < 5 ) {
            $status = $this->natureCall();
        }
        else if($rand >= 5){
            $status = $this->strike($target);
        }
        return $status;
    }

    private function heal ()
    {   $this->heal = true;
        $status = "{$this->name} soigne tous ses points de vie";
        return $status;
    }


    public function setLifePoints($dmg) {
        $this->lifePoints -= $dmg;
        if ($this->lifePoints < 0) {
            $this->lifePoints = 0;
        }
        if($this->heal)
        {
            $this->lifePoints= 100;
        }
        $this->heal = false;
        return;
    }

    private function natureCall()
    {  $this->nature = 3;
        $status = "{$this->name} fait appel à la puissance de la nature!";
        return $status;

    }

    private function strike(Character$target)
    {  $attack = rand(5, 15);
        if ($this->nature >0) {
            $attack *=1.5;
            $this->nature -- ;
            $target->setlifePoints($attack);
            $status = "$this->name donne un coup de baton de point $attack  à  {$target->name}   ! Il reste {$target->getLifePoints()} à {$target->name} !";
        }
            $this->nature=0;
            $target->setlifePoints($attack);
            $status = "$this->name donne un coup de baton à  {$target->name}   ! Il reste {$target->getLifePoints()} à {$target->name} !";

        return $status;

    }
    
}
