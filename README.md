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

# Building & pushing image
## Front
`docker build -t inex_frontend -f ./docker/Dockerfile.staging.frontend . &&
$(aws ecr get-login --no-include-email --region eu-central-1) &&
docker tag inex_frontend:latest 276242186269.dkr.ecr.eu-central-1.amazonaws.com/inex:front &&
docker push 276242186269.dkr.ecr.eu-central-1.amazonaws.com/inex:front`
#### On server
`$(aws ecr get-login --no-include-email --region eu-central-1) && 
docker pull 276242186269.dkr.ecr.eu-central-1.amazonaws.com/inex:front &&
docker stop inex_front && docker rm inex_front &&
docker run -d -p 80:80 --name inex_front 276242186269.dkr.ecr.eu-central-1.amazonaws.com/inex:front`
##Back
`docker build -t inex_backend -f ./docker/Dockerfile.staging.backend . &&
$(aws ecr get-login --no-include-email --region eu-central-1) &&
docker tag inex_backend:latest 276242186269.dkr.ecr.eu-central-1.amazonaws.com/inex:back &&
docker push 276242186269.dkr.ecr.eu-central-1.amazonaws.com/inex:back`
#### On the server
`$(aws ecr get-login --no-include-email --region eu-central-1) && 
docker pull 276242186269.dkr.ecr.eu-central-1.amazonaws.com/inex:back &&
docker stop inex_back && docker rm inex_back &&
docker run -d -p 8001:80 --name inex_back 276242186269.dkr.ecr.eu-central-1.amazonaws.com/inex:back`

#Jenkins
##Initial setup
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