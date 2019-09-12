import React, { useState, useEffect }  from 'react';
import { makeStyles } from '@material-ui/core/styles';
import TextField from '@material-ui/core/TextField';
import Button from "@material-ui/core/Button";
import Container from "@material-ui/core/Container";
import axios from "../Components/Axios/Axios";

const useStyles = makeStyles(theme => ({
    container: {
        display: 'flex',
        flexWrap: 'wrap',
        flexDirection: 'column'
    },
    textField: {
        marginLeft: theme.spacing(1),
        marginRight: theme.spacing(1),
    },
    dense: {
        marginTop: theme.spacing(2),
    },
    menu: {
        width: 200,
    },
    button: {
        margin: theme.spacing(1),
    },
    input: {
        display: 'none',
    },
}));

export default function invoice () {
    const classes = useStyles();


    return (
        <Container maxWidth="sm">
            <form action="http://localhost:8001/api/testpdf" method="get" noValidate autoComplete="off">
                <div className={classes.container}>
                    <TextField
                        id="outlined-name"
                        label="Number"
                        name="number"
                        defaultValue="97"
                        className={classes.textField}
                        margin="normal"
                        variant="outlined"
                    />
                    <TextField
                        id="outlined-name"
                        label="Date of loading"
                        name="date_of_loading"
                        defaultValue="23-24/08/2019"
                        className={classes.textField}
                        margin="normal"
                        variant="outlined"
                    />
                    <TextField
                        id="outlined-name"
                        label="Truck Number"
                        name="truck_number"
                        defaultValue="NT-30-BKM / NT-31-BKM"
                        className={classes.textField}
                        margin="normal"
                        variant="outlined"
                    />
                    <TextField
                        id="outlined-name"
                        label="Driver Name"
                        name="driver_name"
                        defaultValue="Чиореску Андрей (Ciorescu Andrei)"
                        className={classes.textField}
                        margin="normal"
                        variant="outlined"
                    />
                    <TextField
                        id="outlined-name"
                        label="Driver Passport"
                        name="driver_passport"
                        defaultValue="АВ 0520302"
                        className={classes.textField}
                        margin="normal"
                        variant="outlined"
                    />
                    <Button
                        variant="contained"
                        color="primary"
                        className={classes.button}
                        type="submit">
                        Download invoice
                    </Button>
                </div>
            </form>
        </Container>
    )
};

