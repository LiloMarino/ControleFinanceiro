# Use a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instale extensões necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copie os arquivos do projeto para o diretório padrão do Apache
COPY . /var/www/html/

# Ajuste as permissões
RUN chown -R www-data:www-data /var/www/html/

# Defina o ServerName para evitar o aviso
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Exponha a porta 80
EXPOSE 80

# Inicie o Apache
CMD ["apache2-foreground"]
