FROM postgres:latest

ENV POSTGRES_PASSWORD=diploma-thesis

COPY dumb /docker-entrypoint-initdb.d

RUN apt-get update \
  && apt-get --assume-yes install iputils-ping  \
  && apt-get install --assume-yes ssh  \
  && apt-get install --assume-yes net-tools