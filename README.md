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