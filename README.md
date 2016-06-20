Symfony Authentification Demo
=============================

- Demo k ukázce přihlašování do různých částí aplikace

# Zadání
- Máme 2 různé obsahy (test1 a test2) a ke každému se dostaneme pouze po zadání e-mailu
- e-mail si chceme držet pro celé sezení, aby se uživatel nemusel přihlašovat víckrát
- pro přihlášení stačí zadání e-mailu (ten je ale v db unikátní)

- každý test má 3 stránky: index, login a content:
    - index je přístupný všem
    - login je přístupný všem nepřihlášeným
    - content je přístupný všem přihlášeným
