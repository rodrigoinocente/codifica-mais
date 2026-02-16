O servidor inicia com "php -S localhost:8000 -t public" 

Para executar o limpar_log.php
    - Tenha instalado o php-zip. Ex: sudo apt install php8.2-zip
    - Dê permissão ao SO: sudo chmod +x <caminho absoluto do arquivo limpar_log.php>
    - Acesse o Cron com 'crontab -e' e adicione isso na ultima linha
    * * * * * /usr/bin/php <caminho absoluto do arquivo limpar_log.php>
    
    Obs: Com '* * * * *' o Cron será executado a cada minuto.
         A verificação do tamanho do arquivo está baixa.