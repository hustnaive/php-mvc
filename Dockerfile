# Ubuntu 14.04，Trusty Tahr（可靠的塔尔羊）发行版
FROM daocloud.io/ubuntu:trusty

# 道客船长荣誉出品
MAINTAINER Captain Dao <support@daocloud.io>

# APT 自动安装 PHP 相关的依赖包，如需其他依赖包在此添加
RUN apt-get update \
    && apt-get -y install \
        curl \
        wget \
        apache2 \
        libapache2-mod-php5 \
        php5-mysql \
        php5-sqlite \
        php5-gd \
        php5-curl \
        php-pear \
        php-apc \

    # 用完包管理器后安排打扫卫生可以显著的减少镜像大小
    && apt-get clean \
    && apt-get autoclean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \

    # 安装 Composer，此物是 PHP 用来管理依赖关系的工具
    # Laravel Symfony 等时髦的框架会依赖它
    && curl -sS https://getcomposer.org/installer \
        | php -- --install-dir=/usr/local/bin --filename=composer

# Apache 2 配置文件：/etc/apache2/apache2.conf
# 给 Apache 2 设置一个默认服务名，避免启动时给个提示让人紧张.
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \

    # PHP 配置文件：/etc/php5/apache2/php.ini
    # 调整 PHP 处理 Request 里变量提交值的顺序，解析顺序从左到右，后解析新值覆盖旧值
    # 默认设定为 EGPCS（ENV/GET/POST/COOKIE/SERVER）
    
    && sed -i 's/variables_order.*/variables_order = "EGPCS"/g' \
        /etc/php5/apache2/php.ini

# docker-php-ext-install 为官方 PHP 镜像内置命令，用于安装 PHP 扩展依赖
# pdo_mysql 为 PHP 连接 MySQL 扩展
RUN docker-php-ext-install pdo_mysql

# /var/www/html/ 为 Apache 目录
COPY websrc/core /var/www/core
COPY websrc/src /var/www/src
COPY websrc/web /var/www/html
COPY websrc/start.sh /start.sh
RUN chmod 755 /start.sh
EXPOSE 80

CMD ["/start.sh"]