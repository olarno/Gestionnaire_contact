---
name:  Gestionnaire de contact
about: Permettre de stocker ses contacts 

---

## Gestionnaire de contact 

### Description

projet : symfony

En premier lieu une interface d'ajout de contact,
puis permettre de classer ces derniers par groupe afin de pouvoir mieux les organiser.

### Defis relever sur ce projet

- Projet de zéro.
- Initialisation symfony
- Créer un BREAD (browse, read, edit, add, delete)
- Création de fixture (nelmio / faker)
- Utilisation du gestionnaire de formulaire de symfony
- Doctrine ( QueryBuilder )
- Relation de base de données (mcd fourni)
- Utilisation de shema.org pour créer les entité ( documentation founi )
  - Modification de l'entité : retrait de l'affiliation pour le moment

![browse](/Documentation/browse.png)

![read](/Documentation/Read.png)

## Mis à Jour

- Mise en place des formulaires - avec validations & contraintes
- Legere intégration visuelle pour les formulaire (utilisation de bootstrap)
- Création des vues : Homepage (reprenant les listing), les listes par tags

![addPerson](/Documentation/add_person.png)

![addTag](/Documentation/add_tag.png)

![homepage](/Documentation/Homepage.png)

![byTag](/Documentation/Browse_by_tag.png)