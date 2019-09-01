import React, { Component } from 'react';
import Invoice from "./Containers/Invoice";
import Signin from "./Containers/Signin";
import SignUp from "./Containers/Signup";
import Axios from "axios";


class App extends Component {

    render() {
        return (
            <React.Fragment>
                <Invoice/>
            </React.Fragment>
        );
    }
}

export default App;