import React, { Component } from 'react';
import Invoice from "./Containers/Invoice";


class App extends Component {
    render() {
        console.log(process.env);
        console.log(process.env.REACT_APP_SERVER_HOST);
        return (
            <React.Fragment>
                <Invoice/>
            </React.Fragment>
        );
    }
}

export default App;