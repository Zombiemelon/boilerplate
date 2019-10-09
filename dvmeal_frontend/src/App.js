import React from 'react';
import DistributionList from "./Containers/DistributionList";
import SignIn from "./Containers/Signin";
import SignUp from "./Containers/Signup";
import ProtectedRoute from "./Components/Authentication/ProtectedRoute";
import './index.css';
import {Container} from "@material-ui/core";
import { SnackbarProvider } from 'notistack';
import { createMuiTheme } from '@material-ui/core/styles';
import { ThemeProvider } from '@material-ui/styles';
import { Route, Switch, BrowserRouter} from "react-router-dom";


const theme = createMuiTheme({
    palette: {
        primary: {
            light: '#757ce8',
            main: '#22c1c3',
            dark: '#207f84',
            contrastText: '#fff',
        },
        secondary: {
            light: '#ff7961',
            main: '#fdbb2d',
            dark: '#ba000d',
            contrastText: '#000',
        },
    },
});


export default function App () {
    return (
        <BrowserRouter>
                <ThemeProvider theme={theme}>
                    <SnackbarProvider>
                        <Container>
                            <Switch>
                                <ProtectedRoute exact path="/"
                                                component={DistributionList}
                                                allowedRoles={['MANAGER']}/>
                                <ProtectedRoute exact
                                                path="/distribution-list"
                                                component={DistributionList}
                                                allowedRoles={['MANAGER']}/>
                                <Route exact path="/signin" component={SignIn}/>
                                <Route exact path="/signup" component={SignUp}/>
                            </Switch>
                        </Container>
                    </SnackbarProvider>
                </ThemeProvider>
        </BrowserRouter>
    );
}