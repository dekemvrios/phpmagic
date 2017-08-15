# Changelog

Todas as modificações relevantes para phpbreaker serão documentadas neste arquivo

O formato é baseado [Keep a CHANGELOG](http://keepachangelog.com/) e esse projeto adere ao [Semantic Versioning 2.0.0](http://semver.org/).  

## 1.3.0 - 2017-08-15

## Added
- Adicionado suporte a entrada default no schema de propriedades, de modo a atribuir valor padrão a propriedade registro caso nenhum for 
fornecido ao utilizar o método make.

## 1.2.0 - 2017-08-15

## Added
- Adicionado validação para grupo allowedValues presente na definição do schema, lançando instância de TExceptionAbstract caso valor
a ser atribuido a propriedade estiver fora do intervalo válido.

## 1.1.0 - 2017-08-07

## Added
- Modificado assinatura do método da trait HasSchema de boot para start.

## 1.0.0 - 2017-08-03

## Added
- Publicado package considerando versão estável na versão 1.0.0.