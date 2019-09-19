import React, { Component } from 'react';
import Invoice from "./Containers/DistributionList";
import './index.css';
import {Container} from "@material-ui/core";

class App extends Component {
    render() {
        return (
            <React.Fragment>
                <Container>
                    <Invoice/>
                </Container>
            </React.Fragment>
        );
    }
}

export default App;