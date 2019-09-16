import React, { Component } from 'react';
import Invoice from "./Containers/Invoice";

class App extends Component {
    render() {
        console.log(process.env.API_URL);
        console.log(process.env.API_URL);
        return (
            <React.Fragment>
                <Invoice/>
            </React.Fragment>
        );
    }
}

export default App;