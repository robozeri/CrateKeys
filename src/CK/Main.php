<?php

namespace CK;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\item\Item;

class Main extends PluginBase implements Listener
{
    
    public function onEnable() {
		
		if(!file_exists($this->getDataFolder() . "config.yml")) {
            @mkdir($this->getDataFolder());
             file_put_contents($this->getDataFolder() . "config.yml",$this->getResource("config.yml"));
        }
        		$this->getServer()->getPluginManager()->registerEvents($this,$this);
        		$this->getServer()->getLogger()->info("[CrateKeys]Plugin Enabled By SavionLegendZzz");
        }

public function crateKeys(PlayerInteractEvent $event) {
 $player = $event->getPlayer();
    $block = $event->getBlock();
    if($block->getId() == $this->getConfig()->get("Crate") && !$event->isCancelled()) {
        if($player->getInventory()->getItemInHand()->getId() == $this->getConfig()->get("CrateKey-Item")) {
            $prizes = array((Item::get(rand($this->getConfig()->get("ID-1"), $this->getConfig()->get("ID-2")), 0, $this->getConfig()->get("number-of-items"))));

foreach($prizes as $prize){ 
 $player->getInventory()->addItem($prize);
}
$player->sendMessage($this->getConfig()->get("completed"));
            $player->getInventory()->removeItem(item::get($this->getConfig()->get("CrateKey-Item") , 0, 1));
            $event->setCancelled(true);
        }
        else {
            $player->sendMessage($this->getConfig()->get("failed"));
            $event->setCancelled(true); 
        }
    }
    elseif(!$event->isCancelled()) {
        $event->setCancelled(false);
    }
}
}
