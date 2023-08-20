FROM nginx:1.21.6-perl

ENV TZ=America/Sao_Paulo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# basic packages
RUN apt-get update && apt-get install -y \
    vim

EXPOSE 80