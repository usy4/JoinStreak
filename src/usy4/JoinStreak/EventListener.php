<?php

declare(strict_types=1);

namespace usy4\JoinStreak;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

use usy4\JoinStreak\Main;

class EventListener implements Listener {

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        if(!is_dir($this->getDataFolder())){
            @mkdir($this->getDataFolder());
        }
        $this->saveDefaultConfig();
    }

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $name = $player->getName();
        $config = Main::$config;
        $now = time();
        $now_date = date('Y-m-d', $now);
        if($config->exists($name)){
            $streak = $config->get($name);
            $last_join_date = $config->get($name . "_last_join_date");
            if ($last_join_date == $now_date) {
                $player->sendMessage("§7Welcome back! Your join streak remains at§c" . $streak . "§7days.");
            } else {
                $streak++;
                $config->set($name, $streak);
                $player->sendMessage("§7Welcome back! Your join streak is now§c" . $streak . "§7days.");
            }
            $config->set($name . "_last_join_date", $now_date);
            $config->save();
        } else {
            $config->set($name, 1);
            $config->set($name . "_last_join_date", date('Y-m-d', $now));
            $config->save();
            $player->sendMessage("§7Welcome to the server! This is your first time playing, so your join streak is§c" . "1" . "§7day.");
        }
    }

}
