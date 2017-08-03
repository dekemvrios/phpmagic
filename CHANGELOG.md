# Changelog

Todas as modificações relevantes para phpbreaker serão documentadas neste arquivo

O formato é baseado [Keep a CHANGELOG](http://keepachangelog.com/) e esse projeto adere ao [Semantic Versioning 2.0.0](http://semver.org/).  

## [4.0.0] - 2017-08-03

## Changed
- Modificado namespace do projeto de modo a considera-lo como integrante do contexto Expressive.
- Atribuido schema como propriedade estática pertencente a classe que utiliza a trat HasMagic.

## [3.2.0] - 2017-07-10

### Changed
- Atualizado pacote solis/phpbreaker para versão 0.0.2.
- Atualizado pacote solis/phpschema para versão 0.2.0.

## [3.1.0] - 2017-06-21

### Changed
- Adicionado validação de modo a lançar TException caso tentativa de atribuir valor nulo a propriedade definida como required.

## Changed

## [3.0.0] - 2017-06-13

### Changed
- Definido solis/phpschema como mecanismo padrão para construção de schemas.

## [2.0.0] - 2017-05-30

### Changed
- Adicionado mecanismos para construção de schemas.

## [1.2.0] - 2017-05-26

### Changed
- Adicionado solis/phpbreaker como manipulador default de Exceptions.

## [1.1.0] - 2017-05-22

### Changed
- Adicionado validação de modo a atribuir array de instâncias a uma propriedade.

## [1.0.0] - 2017-05-22

### Changed
- Modificado nome de pacote e namespaces para PhpMagic.

## [0.1.0] - 2017-05-22

### Added
- Adicionado entrada no schema de modo a atribuir propriedade como instância de classe.

## [0.0.2] - 2017-05-18

### Fixed
- Modificado chamadas de função internas a magic trait para utilizarem a palavra chave $this.

## [0.0.1] - 2017-05-18

### Added
- Publicação do código fonte na versão 0.0.1.
