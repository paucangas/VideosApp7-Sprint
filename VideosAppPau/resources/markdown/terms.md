# Descripció del projecte

El projecte **VideosApp** consisteix en la creació d'una aplicació web similar a YouTube, on es gestionaran usuaris, vídeos i llistes. A través de diversos sprints, s'implementaran les funcionalitats bàsiques de l'aplicació, incloent la creació i visualització de vídeos, gestió d'usuaris i altres operacions relacionades amb la visualització de contingut.

---

## Sprint 1: Creació del projecte i configuració inicial

### 1. Creació del projecte
Es va crear un projecte Laravel anomenat **'VideosAppPau'**, configurant els següents elements:

- **Jetstream amb Livewire**: Per gestionar l'autenticació i les interaccions dinàmiques.
- **PHPUnit**: Per realitzar proves unitàries.
- **Teams**: Per gestionar equips d'usuaris dins de l'aplicació.
- **SQLite**: Com a base de dades temporal per al desenvolupament inicial.

### 2. Test de helpers
Es va crear un test per verificar la creació de dos tipus d'usuari:

- **Usuari per defecte** amb camps com name, email i password.
- **Usuari professor**, també amb la mateixa estructura.

A més, la contrasenya es va encriptar i els usuaris es van associar a un equip per defecte.

### 3. Configuració de helpers i credencials
Es van crear **helpers** dins la carpeta app per facilitar tasques repetitives, i es va configurar el fitxer config per utilitzar les credencials d'usuaris per defecte carregades des del fitxer .env.

---

## Sprint 2: Migracions, models i proves

### 1. Correcció d'errors
Es van corregir diversos errors detectats durant el primer sprint, incloent l'ús d'una base de dades temporal per als tests, el que va permetre garantir un entorn net i controlat per les proves.

### 2. Migració de vídeos
Es va crear una migració per a la taula de **vídeos** amb els següents camps:

- **id**: Identificador únic del vídeo.
- **title**: Títol del vídeo.
- **description**: Descripció del vídeo.
- **url**: Enllaç al vídeo.
- **published_at**: Data de publicació.
- **previous**: Referència al vídeo anterior (si escau).
- **next**: Referència al vídeo següent (si escau).
- **series_id**: Identificador de la sèrie a la qual pertany el vídeo.

### 3. Controlador i model de vídeos
Es va implementar el controlador **VideosController** amb dues funcions principals:

- **testedBy**: Per realitzar proves específiques associades als vídeos.
- **show**: Per mostrar un vídeo específic.

A més, es va crear el model de **Vídeos** amb funcions per formatar les dates de publicació utilitzant la llibreria **Carbon**.

### 4. Helpers de vídeos per defecte
Es va crear un helper per afegir vídeos per defecte a la base de dades, facilitant així les proves i el desenvolupament inicial.

### 5. Afegir usuaris i vídeos per defecte
Es va configurar el **DatabaseSeeder** per afegir usuaris i vídeos per defecte a la base de dades, assegurant-se que l'aplicació disposés de dades de prova per als tests.

### 6. Creació de layout i rutes
Es va crear el layout **VideosAppLayout**, que es va utilitzar per estructurar les vistes de l'aplicació. A més, es van definir les rutes per mostrar els vídeos en el frontend.

### 7. Proves de vídeos
Es van crear diverses proves per garantir el correcte funcionament de les funcionalitats de vídeos, incloent:

- Creació de vídeos per defecte.
- Visualització correcta dels vídeos.
- Accés als vídeos per part dels usuaris, incloent proves de permisos i validacions de l'usuari autenticat.

---

## Sprint 3: Funcionalitats d'usuaris, permisos i tests

### 1. Corregir els errors del 2n sprint
Es van corregir els errors detectats durant el segon sprint.

### 2. Instal·lació de spatie/laravel-permission
Es va instal·lar el paquet spatie/laravel-permission per gestionar els rols i permisos dels usuaris dins de l'aplicació, seguint la documentació oficial per a la instal·lació.

### 3. Migració per afegir el camp super_admin
Es va crear una migració per afegir el camp super_admin a la taula **users**.

### 4. Afegir funcions al model d'usuaris
Es va afegir la funció testedBy() i la funció isSuperAdmin() al model d'usuari per gestionar la lògica dels permisos.

### 5. Funcions per a la creació d'usuaris
Es va crear la funció create_default_professor() per afegir el superadmin al professor, així com altres funcions per crear usuaris de tipus **regular**, **video manager** i **superadmin**:

- **create_regular_user()**
- **create_video_manager_user()**
- **create_superadmin_user()**

A més, es va implementar la funció define_gates() per definir les portes d'autorització i les funcions create_permissions() per crear permisos predeterminats.

### 6. Política d'autorització
A la funció book de **AppServiceProvider**, es van registrar les polítiques d'autorització i es van definir les portes d'accés per gestionar els permisos dels usuaris.

### 7. Afegir usuaris i permisos al DatabaseSeeder
Es van afegir usuaris per defecte (superadmin, regular user, video manager) i permisos al **DatabaseSeeder** per garantir que els usuaris i els rols es creessin correctament en la base de dades.

### 8. Publicar els stubs
Es va publicar els stubs per personalitzar la generació de fitxers, seguint la guia de Laravel per personalitzar els stubs.

### 9. Crear tests de vídeos
Es va crear el test **VideosManageControllerTest** dins de la carpeta tests/Feature/Videos, amb les funcions següents per comprovar la gestió de vídeos:

- user_with_permissions_can_manage_videos()
- regular_users_cannot_manage_videos()
- guest_users_cannot_manage_videos()
- superadmins_can_manage_videos()
- loginAsVideoManager()
- loginAsSuperAdmin()
- loginAsRegularUser()

### 10. Crear test d'usuaris
Es va crear el test **UserTest** a la carpeta tests/Unit, amb la funció isSuperAdmin() per validar la lògica associada als superadmins.

### 11. Afegir documentació
Es va afegir la descripció dels sprints a **resources/markdown/terms** per mantenir la documentació del projecte actualitzada.

### 12. Comprovar fitxers amb Larastan
Es va utilitzar **Larastan** per comprovar els fitxers creats i assegurar la qualitat del codi.

---

## Sprint 4: Implementació del CRUD de vídeos i millores d'interfície

### 1. Correcció dels errors del 3r sprint
Es van corregir els errors detectats durant el tercer sprint, incloent la verificació dels permisos d'accés a la ruta `/videosmanage` per part dels usuaris amb permisos corresponents.

### 2. Creació del VideosManageController
Es va crear el controlador **VideosManageController** amb les següents funcions:

- **testedBy**: Per realitzar proves específiques associades al controlador.
- **index**: Per mostrar la llista de vídeos.
- **store**: Per emmagatzemar un nou vídeo.
- **show**: Per mostrar un vídeo específic.
- **edit**: Per mostrar el formulari d'edició d'un vídeo.
- **update**: Per actualitzar un vídeo existent.
- **delete**: Per mostrar la confirmació d'eliminació d'un vídeo.
- **destroy**: Per eliminar un vídeo.

### 3. Implementació de la funció index a VideosController
Es va implementar la funció **index** al controlador **VideosController** per mostrar tots els vídeos disponibles.

### 4. Revisió i creació de vídeos per defecte
Es va revisar que hi haguessin 3 vídeos creats als helpers i afegits al **DatabaseSeeder** per garantir que les dades de prova estiguessin disponibles per als tests.

### 5. Creació de vistes per al CRUD de vídeos
Es van crear les següents vistes per gestionar el CRUD de vídeos, accessibles només pels usuaris amb els permisos corresponents:

- **resources/views/videos/manage/index.blade.php**: Vista per mostrar la llista de vídeos amb una taula CRUD.
- **resources/views/videos/manage/create.blade.php**: Vista amb el formulari per crear un nou vídeo, utilitzant l'atribut `data-qa` per facilitar els tests.
- **resources/views/videos/manage/edit.blade.php**: Vista amb el formulari per editar un vídeos existent.
- **resources/views/videos/manage/delete.blade.php**: Vista per confirmar l'eliminació d'un vídeo.

### 6. Implementació de la vista principal de vídeos
Es va crear la vista **resources/views/videos/index.blade.php** per mostrar tots els vídeos de manera similar a la pàgina principal de YouTube. En clicar a un vídeo, es redirigeix a la vista de detall (show) implementada en sprints anteriors.

### 7. Modificació del test user_with_permissions_can_manage_videos
Es va modificar el test **user_with_permissions_can_manage_videos** per assegurar-se que hi haguessin 3 vídeos disponibles per a les proves.

### 8. Creació de permisos per al CRUD de vídeos
Es van crear permisos específics per al CRUD de vídeos als helpers i assignar-los als usuaris corresponents (superadmin, video manager, etc.).

### 9. Creació de tests addicionals
Es van crear les següents funcions de test:

- **VideoTest**:
    - user_without_permissions_can_see_default_videos_page
    - user_with_permissions_can_see_default_videos_page
    - not_logged_users_can_see_default_videos_page

- **VideosManageControllerTest**:
    - loginAsVideoManager
    - loginAsSuperAdmin
    - loginAsRegularUser
    - user_with_permissions_can_see_add_videos
    - user_without_videos_manage_create_cannot_see_add_videos
    - user_with_permissions_can_store_videos
    - user_without_permissions_cannot_store_videos
    - user_with_permissions_can_destroy_videos
    - user_without_permissions_cannot_destroy_videos
    - user_with_permissions_can_see_edit_videos
    - user_without_permissions_cannot_see_edit_videos
    - user_with_permissions_can_update_videos
    - user_without_permissions_cannot_update_videos
    - user_with_permissions_can_manage_videos
    - regular_users_cannot_manage_videos
    - guest_users_cannot_manage_videos
    - superadmins_can_manage_videos

### 10. Configuració de rutes per al CRUD de vídeos
Es van configurar les rutes per al CRUD de vídeos sota el prefix `/videos/manage`, amb middleware per garantir que només els usuaris autenticats puguin accedir-hi. La ruta de l'índex de vídeos es va configurar per ser accessible tant per usuaris autenticats com no autenticats.

### 11. Afegir navbar i footer a la plantilla
Es va afegir un **navbar** i un **footer** a la plantilla **resources/layouts/videosapp.blade.php** per permetre la navegació entre pàgines de manera consistent.

### 12. Actualització de la documentació
Es va afegir la descripció del quart sprint al fitxer **resources/markdown/terms.md** per mantenir la documentació del projecte actualitzada.

### 13. Comprovació de fitxers amb Larastan
Es va utilitzar **Larastan** per comprovar tots els fitxers creats durant aquest sprint, assegurant la qualitat i l'estandardització del codi.

---

**Conclusió:**
Amb aquest quart sprint, s'ha implementat el CRUD complet per a la gestió de vídeos, juntament amb les vistes necessàries i els tests corresponents. A més, s'ha millorat la interfície d'usuari amb l'addició d'un navbar i un footer. Els pròxims passos inclouran la implementació de funcionalitats addicionals i millores en l'experiència d'usuari.

---

## Sprint 5: Gestió d’usuaris i millores finals

### Descripció del 5è Sprint

Durant aquest sprint s’han implementat funcionalitats relacionades amb la gestió d’usuaris i la millora de l’aplicació, corregint errors de sprints anteriors i afegint noves funcionalitats. A continuació es detalla tot el que s’ha fet:

- S’han corregit els errors detectats al quart sprint.
- S’ha afegit el camp `user_id` a la taula de vídeos, per tal que cada vídeo quedi associat a l’usuari que l’ha creat. Això ha implicat modificar el model, el controlador i els helpers relacionats.
- En cas que s’hagin trencat tests anteriors amb aquestes modificacions, s’han arreglat per mantenir la coherència del projecte.
- S’ha creat el controlador `UsersManageController` amb les següents funcions:
    - `testedBy`
    - `index`
    - `store`
    - `edit`
    - `update`
    - `delete`
    - `destroy`
- També s’ha creat la funció `index` i `show` al `UsersController`.
- S’han creat les vistes per a la gestió del CRUD d’usuaris, disponibles només per als usuaris amb els permisos adients:
    - `resources/views/users/manage/index.blade.php`
    - `resources/views/users/manage/create.blade.php`
    - `resources/views/users/manage/edit.blade.php`
    - `resources/views/users/manage/delete.blade.php`
- A la vista `index.blade.php` s’ha afegit la taula amb els usuaris del CRUD.
- A la vista `create.blade.php` s’ha afegit el formulari per afegir usuaris amb atributs `data-qa` per facilitar les proves automatitzades.
- A la vista `edit.blade.php` s’ha afegit el formulari per editar els usuaris.
- A la vista `delete.blade.php` s’ha afegit una confirmació d’eliminació de l’usuari.
- S’ha creat la vista `resources/views/users/index.blade.php` per mostrar tots els usuaris, amb funcionalitat de cerca i accés al detall de l’usuari i els seus vídeos.
- Al fitxer de `helpers` s’han creat els permisos de gestió d’usuaris per al CRUD i s’han assignat als usuaris amb rol `superadmin`.

### Tests creats

#### A `UserTest`:

- `user_without_permissions_can_see_default_users_page`
- `user_with_permissions_can_see_default_users_page`
- `not_logged_users_cannot_see_default_users_page`
- `user_without_permissions_can_see_user_show_page`
- `user_with_permissions_can_see_user_show_page`
- `not_logged_users_cannot_see_user_show_page`

#### A `UsersManageControllerTest`:

- `loginAsVideoManager`
- `loginAsSuperAdmin`
- `loginAsRegularUser`
- `user_with_permissions_can_see_add_users`
- `user_without_users_manage_create_cannot_see_add_users`
- `user_with_permissions_can_store_users`
- `user_without_permissions_cannot_store_users`
- `user_with_permissions_can_destroy_users`
- `user_without_permissions_cannot_destroy_users`
- `user_with_permissions_can_see_edit_users`
- `user_without_permissions_cannot_see_edit_users`
- `user_with_permissions_can_update_users`
- `user_without_permissions_cannot_update_users`
- `user_with_permissions_can_manage_users`
- `regular_users_cannot_manage_users`
- `guest_users_cannot_manage_users`
- `superadmins_can_manage_users`

### Rutes i permisos

- S’han creat les rutes de `users/manage` per al CRUD d’usuaris amb el middleware corresponent.
- També s’han creat les rutes d’índex i detall (`show`) d’usuaris.
- Aquestes rutes només són visibles quan l’usuari està logejat.

### Altres tasques

- S’ha assegurat que es pot navegar correctament entre totes les pàgines creades.
- S’ha documentat el que s’ha fet al fitxer `resources/markdown/terms`.
- S’ha passat Larastan per comprovar que no hi ha errors als nous fitxers.

---

**Conclusió:**
Aquest sprint ha suposat una ampliació important del projecte, incorporant funcionalitats completes per a la **gestió d’usuaris**, control de permisos i validacions. A més, s’ha millorat la robustesa i mantenibilitat del codi assegurant que tots els tests passin correctament i afegint una cobertura extensa. El projecte es troba ara en un estat molt més madur i preparat per a entorns reals, amb capacitat per escalar funcionalitats o integrar nous rols d’usuari en el futur.

# Sprint 6 - Implementació del CRUD de Sèries i Gestió de Vídeos

## Introducció
Durant el Sprint 6 s'han implementat diverses funcionalitats relacionades amb la gestió de sèries i vídeos dins de l'aplicació. Els objectius principals han estat crear un sistema que permeti als usuaris gestionar sèries i vídeos, incloent-hi la creació de sèries, l'assignació de vídeos a aquestes, la possibilitat de crear vídeos per part dels usuaris regulars i la gestió de permisos per a accedir a aquestes funcionalitats. A més, també s'han creat les proves necessàries per assegurar que tot el sistema funciona correctament.

---

## 1. Implementació del CRUD de Sèries

### Descripció
S'ha creat el CRUD (Create, Read, Update, Delete) per a la gestió de sèries. Això inclou totes les funcionalitats bàsiques per crear, editar, visualitzar i eliminar sèries. S'ha utilitzat Laravel per implementar els models, controladors i vistes necessàries per aquest CRUD.

### Detalls
- **Model de Series**: El model `Series` s'ha creat amb els camps `id`, `title`, `description`, `image`, `user_name`, `user_photo_url` i `published_at`. A més, s'ha afegit la relació 1:N amb el model `Video`, permetent així que una sèrie pugui tenir múltiples vídeos associats.
- **Migració de Sèries**: S'ha creat una migració per crear la taula `series` a la base de dades amb tots els camps mencionats.
- **Controladors i Rutes**: S'han creat els controladors `SeriesManageController` i `SeriesController`, amb funcions per mostrar la llista de sèries (`index`), editar-les (`edit`), actualitzar-les (`update`), eliminar-les (`destroy`), així com mostrar les sèries individuals amb la seva informació (`show`).
- **Vistes**: S'han creat les vistes per gestionar les sèries, incloent formularis per crear i editar sèries, i una vista per mostrar la llista de sèries amb les opcions d'editar i eliminar.

---

## 2. Assignació de Vídeos a les Sèries

### Descripció
Una part essencial d'aquest Sprint ha estat permetre l'assignació de vídeos a les sèries. Això significa que cada vídeo pot ser associat a una sèrie específica, creant una relació entre els models `Video` i `Series`.

### Detalls
- **Relació 1:N entre Sèries i Vídeos**: S'ha afegit una relació 1:N al model `Video`, permetent que cada vídeo tingui una sèrie assignada.
- **Vistes de Vídeos**: S'han creat funcionalitats per mostrar els vídeos dins de les sèries. Quan es visualitza una sèrie, es poden veure tots els vídeos associats a aquesta sèrie.
- **Formulari de Creació de Vídeos**: S'ha afegit un formulari a la vista de creació de vídeos, que permet assignar un vídeo a una sèrie existent. El formulari utilitza un selector per a triar la sèrie a la qual s'assignarà el vídeo.

---

## 3. Permisos per als Usuaris Regulars

### Descripció
Es va permetre que els usuaris regulars puguin crear vídeos dins de l'aplicació. Per això, s'han creat mecanismes de permisos i control d'accés per tal que només aquells usuaris amb els permisos adequats puguin accedir a les funcionalitats de creació, edició i eliminació de vídeos i sèries.

### Detalls
- **Gestió de Permisos**: S'han creat rutes protegides amb middleware per assegurar que només els usuaris amb permisos adequats puguin gestionar sèries i vídeos. Els permisos per gestionar sèries han estat assignats als usuaris de tipus `superadmin` i `videomanager`.
- **Control d'Accés per Rols**: S'han afegit permisos específics per a usuaris regulars, de manera que no podran accedir a les funcionalitats d'editar o eliminar sèries i vídeos, però podran crear-los.
- **Proves de Permisos**: S'han creat proves per garantir que només els usuaris amb permisos poden realitzar accions com crear, editar o eliminar sèries i vídeos. Els usuaris sense permisos veuran un missatge d'error o no podran accedir a aquestes funcionalitats.

---

## 4. Creació de Proves per al CRUD de Sèries

### Descripció
Es van afegir proves unitàries i de funcionalitat per garantir que el sistema de gestió de sèries i vídeos funciona correctament. Aquestes proves cobreixen casos com la creació, edició i eliminació de sèries, així com la validació de les relacions entre sèries i vídeos.

### Detalls
- **Proves Unitàries**: Es van crear proves per verificar que les sèries poden tenir vídeos associats correctament, utilitzant funcions com `serie_have_videos()`.
- **Proves de Funcionalitat**: Es van afegir proves de funcionalitat per verificar que només els usuaris amb permisos poden veure i gestionar les sèries (per exemple, `user_with_permissions_can_see_add_series`, `user_without_permissions_cannot_see_add_series`).
- **Proves de Rutes i Middleware**: Es van afegir proves per assegurar que les rutes del CRUD de sèries i vídeos estan protegides per middleware de permisos adequats i que només els usuaris autenticats poden accedir-hi.

---

## 5. Afegir Rutes per al CRUD de Sèries

### Descripció
Es van definir noves rutes per al CRUD de les sèries, protegides per middleware d'autenticació i permisos. Això assegura que només els usuaris autenticats i autoritzats poden accedir a aquestes rutes.

### Detalls
- **Rutes Protegides**: S'han creat les rutes per la gestió de sèries sota el controlador `SeriesManageController`, i aquestes rutes estan protegides per middleware d'autenticació i permisos. Les rutes inclouen accions com la creació (`store`), edició (`edit`), actualització (`update`) i eliminació (`destroy`) de sèries.
- **Rutes d'Index i Show de Sèries**: A part del CRUD, també es va afegir la ruta per visualitzar totes les sèries i mostrar una sèrie individual amb els seus vídeos associats.

---

## 6. Documentació del Sprint i Revisions

### Descripció
Per mantenir un registre clar del que s'ha fet durant el Sprint, es va afegir una documentació completa de les tasques realitzades i els avenços assolits en el fitxer `resources/markdown/terms`. Aquesta documentació inclou una explicació detallada de cada tasca i les funcions que es van implementar.

### Detalls
- **Documentació a `terms.md`**: S'ha documentat tot el treball realitzat durant el Sprint 6, incloent-hi les implementacions de models, controladors, rutes, vistes i proves.
- **Revisió en Larastan**: Per garantir la qualitat del codi, es va fer una revisió del codi mitjançant Larastan, identificant possibles errors i advertències per millorar el codi creat.

---

## Conclusió
El Sprint 6 ha estat crucial per a la creació del sistema de gestió de sèries i vídeos, amb un enfocament especial en la creació de funcionalitats per als usuaris regulars i la protecció per permisos. A més, s'ha creat una documentació completa per garantir que tots els canvis i millores estan ben registrats i entesos per tots els membres de l'equip. Amb les proves implementades, el sistema és més robust i fiable.

# Sprint 7 - Esdeveniments, Notificacions i Broadcast amb Pusher

## Introducció
Durant el Sprint 7 s'han implementat funcionalitats relacionades amb la gestió d'esdeveniments, notificacions i el sistema de difusió en temps real mitjançant Pusher. L'objectiu principal ha estat millorar l'experiència d'usuari proporcionant notificacions automàtiques quan es creen vídeos, tant via correu electrònic com per push en temps real. També s'han afegit les proves corresponents i s'ha documentat el procés per mantenir la qualitat del codi.

---

## 1. Esdeveniment `VideoCreated` i Listener

### Descripció
S'ha creat un esdeveniment que es dispara automàticament quan es crea un vídeo, i un listener que escolta aquest esdeveniment i envia notificacions als administradors.

### Detalls
- **VideoCreated**: Esdeveniment amb constructor i funcions `broadcastOn()` i `broadcastAs()` per emetre'l.
- **SendVideoCreatedNotification**: Listener associat que envia notificacions a tots els administradors registrats.
- **EventServiceProvider**: S'ha registrat l'esdeveniment i el listener en el proveïdor de serveis corresponent.

---

## 2. Enviament de correus amb Mailtrap

### Descripció
S'ha configurat Mailtrap com a servei de correu electrònic per enviar notificacions quan es crea un vídeo.

### Detalls
- **Configuració `.env`**: Afegides les credencials de Mailtrap.
- **Prova d'enviament**: Verificat que s'envien correus als administradors amb la informació del vídeo nou.

---

## 3. Notificacions Push amb Pusher i Laravel Echo

### Descripció
S'ha integrat Pusher i Laravel Echo per emetre notificacions en temps real al navegador.

### Detalls
- **Configuració de Pusher**: Afegida la configuració a `broadcasting.php` i `.env`.
- **Instal·lació de dependències**: S'han instal·lat `laravel-echo` i `pusher-js` via npm.
- **Configuració de Echo**: S'ha afegit el codi de configuració a `resources/js/bootstrap.js`.
- **Rebuda de notificacions**: S'ha creat una vista que mostra les notificacions push rebudes pels usuaris.

---

## 4. Proves de funcionalitat i esdeveniments

### Descripció
S'han implementat proves unitàries i de funcionalitat per assegurar que el sistema de notificacions i esdeveniments funciona correctament.

### Detalls
- **Proves implementades**:
    - `test_video_created_event_is_dispatched()`: Verifica que l’esdeveniment s’envia correctament.
    - `test_push_notification_is_sent_when_video_is_created()`: Verifica que la notificació push arriba.

---

## 5. Documentació i Qualitat del Codi

### Descripció
Per tal de mantenir un registre i assegurar la qualitat, s’ha documentat aquest sprint i s’han executat eines d’anàlisi estàtica del codi.

### Detalls
- **Documentació**: Afegit resum complet a `resources/markdown/terms/7e_sprint.md`.
- **Larastan**: Revisió completa del codi modificat per garantir que compleix amb els estàndards establerts.

---

## Conclusió
El Sprint 7 ha estat clau per a incorporar funcionalitats de temps real mitjançant esdeveniments i notificacions, millorant la interacció de l’usuari amb el sistema. La integració amb Pusher i Laravel Echo permet que els administradors rebin notificacions instantànies, i el sistema de correus assegura una comunicació eficaç. Les proves i la documentació aporten robustesa i mantenibilitat al projecte.

