# sonata-page-delete-bug

**Bug description**: a page can't be deleted using the edit view button. It can only be deleted using the list view.

**Requirements to reproduce**: [Docker Desktop](https://www.docker.com/products/docker-desktop) and [Visual Studio Code](https://code.visualstudio.com) with the [Dev Containers extension](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers) installed.

1. Clone this repository
2. Create `.env.local` file with the following content:

    ```env
    DATABASE_URL="mysql://root:@db:3306/app?serverVersion=11.0.2-MariaDB&charset=utf8mb4"
    MAILER_DSN=null://null
    ```

3. Open Visual Studio Code and reopen the project in Container
4. Run the following:

    ```bash
    composer install
    ```

    ```bash
    bin/console doctrine:migrations:migrate -n
    ```

    ```bash
    bin/console sonata:page:create-site --name=localhost --host=localhost --relativePath="" --enabled --enabledFrom=- --enabledTo=- --default --locale=-
    ```

    ```bash
    bin/console sonata:page:update-core-routes --site=all
    ```

    ```bash
    bin/console sonata:page:create-snapshots --site=all
    ```

5. Create the user `foo` with password `bar`:

    ```bash
    bin/console sonata:user:create foo foo@example.com bar --super-admin
    ```

5. Access http://localhost/admin/app/sonatapagepage/create and create a new page named i.e. "foo"
6. Delete the page "foo" from the edit page
