#Frontend Dependencies
React - core of the project, JS library
ReactDOM - allows to render DOM in React

Axios - AJAX request tool

Webpack - JS bundler, collect js, html, css etc. into one or several bundles for lazy loading
Webpack CLI - CLI utility for Webpack

Lodash - TO BE CHECKED

Babel-core - Transforms your ES6 code into ES5
Babel-loader - Webpack helper to transform your JavaScript dependencies (for example, when you import your components into other components) with Babel
Babel-preset-env - Determines which transformations/plugins to use and polyfills (provide modern functionality on older browsers that do not natively support it) based on the browser matrix you want to support
Babel-preset-react - Babel preset for all React plugins, for example turning JSX into functions
Babel-plugin-proposal-class-properties - allows to use state = {} in React

styled-components - used for styling components instead of CSS. Adds auto prefixing of CSS classes & implements CSS-in-JS logic
babel-plugin-styled-components - allows to use css prop for styled components, so you can write like `<div css="padding: 5px"></div>`

CSS-loader - process css
style-loader - injects css to html
sass-loader - process sass
file-loader - process images & icons

html-webpack-plugin - dev dependency inserts <script> to /dist/index.html

jest - testing tools. Jest acts as a **test runner**, **assertion library**, and **mocking library** [![Nice tutorial on Medium](https://medium.com/codeclan/testing-react-with-jest-and-enzyme-20505fec4675)
jest-svg-transformer - allows jest to parse svg
jest-styled-components - allows to test styled components and ignore their auto generated `className`
identity-obj-proxy - allows jest to parse css|styl|less|sass|scss|png|jpg|ttf|woff|woff2
react-test-renderer - for rendering snapshots
enzyme - adds some great additional utility methods for **rendering a component** (or multiple components), **finding elements**, and **interacting with elements**.
enzyme-to-json - provides a better component format for snapshot comparison than Enzyme’s internal component representation. 
snapshotSerializers allows you to minimise code duplication when working with snapshots. 
Without the serializer each time a component is created in a test it must have the enzyme-to-json method .toJson() used individually before it can be passed to Jest’s snapshot matcher, with the serializer you never use it individually.
enzyme-adapter-react-16 - allows Enzyme to work with React
babel-jest - allow jest usage with babel
dotenv - allows to use `.env` to set environment variable. Read here how it should be written in Webpack https://medium.com/@trekinbami/using-environment-variables-in-react-6b0a99d83cf5.
notistack - used for snackbars

#Front logic
1. There are protected routes that check user id in `<ProtectedRoute/>` component.
There you can set what roles can access the routes. On the backend routes are protected as well.


#Backend
1. Routes are protected with middleware that is fire when route is used doing a checks that are required. 
For example, check that HTTP request contains all required fields.
2. Controller actions are protected by Gates that are registered in `AuthServiceProvider.php`

#Jenkins
##Initial setup
(!) Very important to use swap for small AWS instances
`sudo fallocate -l 2G /swapfile && 
sudo chmod 600 /swapfile && 
sudo mkswap /swapfile && 
sudo swapon /swapfile`

https://linuxize.com/post/create-a-linux-swap-file/

1. Install Docker
`apt-get update &&
 apt-get install -y apt-transport-https ca-certificates curl software-properties-common &&
 curl -fsSL https://download.docker.com/linux/ubuntu/gpg | apt-key add - &&
 add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu bionic stable" &&
 apt-get update &&
 apt-cache policy docker-ce &&
 apt-get install -y docker-ce`
 2. Download docker image `docker pull jenkinsci/blueocean`
 3. Put AWS access key to `/home/ubuntu/.aws`
 4. Launch container in interactive mode, so you could see admin password and copy it. 
 `-v /var/run/docker.sock:/var/run/docker.sock` is used so you can run Docker inside Docker
 `docker run -p 8080:8080 -p 50000:50000 -v /var/jenkins_home:/var/jenkins_home -v /var/run/docker.sock:/var/run/docker.sock jenkinsci/blueocean`
 5. Then run container in detached mode `docker run --name jenkins -d -p 8080:8080 -p 50000:50000 -v /var/jenkins_home:/var/jenkins_home -v /var/run/docker.sock:/var/run/docker.sock -v /home/ubuntu/.aws:/root/.aws jenkinsci/blueocean`.
 Here we put the following volumes:<br />
 a. jenkins_home - contains all data about jenkins, so when container is restarted you don't have to set up all over again<br />
 b. docker.sock - allows to use docker inside Jenkins container without additional installation
 c. .aws - aws access key that is used to authenticate before pushing to ECR
5. Install Python`apk add --no-cache --update python3`
6. Install AWS CLI as non roo `pip3 install awscli --upgrade --user`
6. Get AWS Credentials `$(/root/.local/bin/aws ecr get-login --no-include-email --region eu-central-1)`
7. Give rights to `ubuntu` user on remote host for `var/run/docker.sock`
8. Install AWS CLI on remote host
9. Start mysql `docker run -p 3306:3306 --name mysql -v /db_volume:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=govno666 -e MYSQL_DATABASE=inex -e MYSQL_USER=inex -e MYSQL_PASSWORD=ueOQrisTgqP2I+9TmOYU2myQS1TCeVuVL0xZNOxNb44= -d mysql:5.7`

# TODO
1. Add fields validator middleware to the `/distributionList` route
2. Use one http call for DistributionList component
3. Split email & download actions