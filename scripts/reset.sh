#!/bin/bash
config="PhpStorm2020.2"
key="PhpStorm202.evaluation.key"

echo ~/.config/JetBrains/$config
echo "eval/$key"

cd ~/.config/JetBrains/$config && rm eval/$key && rm options/other.xml
cd ~/.java/.userPrefs/jetbrains && rm -rf phpstorm
