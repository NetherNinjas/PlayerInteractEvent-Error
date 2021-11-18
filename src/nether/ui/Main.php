<?php

namespace nether\ui;

use pocketmine\{Server, Player};
use pocketmine\command\{Command, CommandSender};
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as T;
use pocketmine\item\Item;
use pocketmine\event\player\PlayerInteractEvent;

class Main extends PluginBase implements Listener {

	public $interactDelay = [];

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("Plugin Activated");
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
		switch ($command->getName()){
			case "dl":
				if($sender instanceof Player){
					$this->openMyUi($sender);
				}
            break;
				
        }
		return true;
	}

    public function onInteract(PlayerInteractEvent $event){
        $player = $event->getPlayer();
        $item = $event->getItem();
        if($item->getID() == 267){
            if(!isset($this->interactDelay[$player->getName()])){
                $this->interactDelay[$player->getName()] = time() + 1;
                $this->openMyUi($player);
            } else {
                if(time() >= $this->interactDelay[$player->getName()]){
                    unset($this->interactDelay[$player->getName()]);
                }

            }
        }
    }

	public function openMyUi($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if($result === null){
				return true;
			}
			switch ($result){
				case 0:
          
				break;  

                case 1:
          
                break;
                
                case 2:
          
                break;  
    
                case 3:
              
                break;  

                case 4:
          
                break;  
    
                case 5:
              
                break;  
    
    

			}
		});
		$form->setTitle("§9§lDuels");
		$form->addButton("§9§lBuild UHC");
        $form->addButton("§9§lGapple");
        $form->addButton("§9§lCombo");
        $form->addButton("§9§lSumo");
		$form->addButton("§9§lNoDebuff");
        $form->addButton("§9§lFist");
		$form->sendToPlayer($player);
		return $form;
	}
}