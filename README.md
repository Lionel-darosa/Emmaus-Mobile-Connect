## Emmaüs Mobile Connect :iphone:
*A hackathon project*

### Description

**Context**
- Emmaüs Connect is deeply committed to promoting digital inclusion on a daily basis. They address this objective by selling electronic goods, with a particular emphasis on smartphones, which play a crucial role in bridging the digital divide.

**Hackathon mission**
- Our mission was to develop a smartphone classification tool capable of generating accurate selling prices based on key features such as RAM, storage, and more.

**About our work**
- In addition to the development of the smartphone pricing tool, we decided to go a step further by creating a sales assistant feature. This addition is intended to enable the volunteers at Emmaüs, who may not be familiar with smartphone technology, to better cater to the specific needs of customers.

It is with great pride that our comprehensive approach earned us the distinction of winning the "Best Concept" award :tada: :blush: :green_heart:

**You can find a demo of the application [here](https://www.loom.com/share/a952e632496e45788dcad61332cc5e5c?sid=8b2dbf5a-c546-4965-884c-196ef57503a7)!**

We used Symfony 6.3.0 to build it.

### Steps

Here are the steps to use the application :

1. Clone the repo from Github
2. Run `composer install` and `yarn install` in your CLI
3. Create and configure _.env.local_ from _.env_ file and add your database parameters by entering your mySQL credentials and the name of your database
4. Run `symfony console doctrine:database:create` to create your database 
5. Run `symfony console doctrine:migrations:migrate` to import the content of the database app
6. Run `symfony console doctrine:fixtures:load` to import the fixtures into the database
7. Run the internal Symfony webserver with `symfony server:start`
8. Run `yarn build` and then `yarn dev-server` to launch Webpack
9. Go to `localhost:8000` with your favorite browser.

For more info about setting up an existing Symfony project, you can read the following documentation [here](https://symfony.com/doc/current/setup.html#setting-up-an-existing-symfony-project).
