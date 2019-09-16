import React, { useState, useEffect }  from 'react';
import { makeStyles } from '@material-ui/core/styles';
import TextField from '@material-ui/core/TextField';
import Button from "@material-ui/core/Button";
import Container from "@material-ui/core/Container";
import MenuItem from "@material-ui/core/MenuItem";
import Select from "@material-ui/core/Select";
import FormControl from "@material-ui/core/FormControl";
import InputLabel from "@material-ui/core/InputLabel";
import Hidden from "@material-ui/core/Hidden";
import axios from "../Components/Axios/Axios";
import {Input} from "@material-ui/icons";

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

    root: {
        display: 'flex',
        flexWrap: 'wrap',
    },
    formControl: {
        margin: theme.spacing(1),
        minWidth: 120,
    },
    selectEmpty: {
        marginTop: theme.spacing(2),
    },
}));

export default function invoice () {
    const classes = useStyles();
    const [drivers, setDrivers] = useState([]);
    const [driver, setDriver] = useState([]);
    const [truck, setTruck] = useState([]);
    const [trucks, setTrucks] = useState([]);

    const getDrivers = () => {
        axios.get('/api/drivers').then(response =>  {
            setDrivers(response.data);
        });
    };

    const getTrucks = () => {
        axios.get('/api/trucks').then(response =>  {
            console.log(response.data)
            setTrucks(response.data);
        });
    };

    const inputLabel = React.useRef(null);
    const [labelWidth, setLabelWidth] = React.useState(0);
    React.useEffect(() => {
        setLabelWidth(inputLabel.current.offsetWidth);
    }, []);

    useEffect(() => {
        getDrivers();
        getTrucks();
    }, []);

    const selectDriver = (driverId) => {
       let driver = drivers[driverId];
       drivers.forEach((option) => {
           if(option.id === driverId) {
               driver = option
           }
       });
       setDriver(driver);
    };

    const selectTruck = (truckId) => {
        let truck = trucks[truckId];
        trucks.forEach((option) => {
            if(option.id === truckId) {
                truck = option
            }
        });
        setTruck(truck);
        console.log(truck);
    };

    return (
        <Container maxWidth="sm">
            <form action={`${process.env.API_URL}/api/invoice`} method="get" noValidate autoComplete="off">
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
                    <FormControl variant="outlined" className={classes.formControl}>
                        <InputLabel ref={inputLabel} htmlFor="drivers">
                            Trucks
                        </InputLabel>
                        <Select
                            value={truck.plate_number ? truck.plate_number : ""}
                            renderValue={()=> truck.plate_number ? truck.plate_number : "Trucks"}
                            onChange={(e) => selectTruck(e.target.value)}
                            name="truck_number"
                            labelWidth={labelWidth}
                            inputProps={{
                                id: 'trucks',
                            }}
                        >
                            {trucks.map(option => (
                                <MenuItem key={option.id} value={option.id}>
                                    {option.plate_number}
                                </MenuItem>
                            ))}
                        </Select>
                    </FormControl>
                    <FormControl variant="outlined" className={classes.formControl}>
                        <InputLabel ref={inputLabel} htmlFor="drivers">
                            Drivers
                        </InputLabel>
                        <Select
                            value={driver.id ? `${driver.name} ${driver.surname}` : ""}
                            renderValue={()=> driver.id ? `${driver.name} ${driver.surname}` : "Drivers"}
                            onChange={(e) => selectDriver(e.target.value)}
                            name="driver_name"
                            labelWidth={labelWidth}
                            inputProps={{
                                id: 'drivers',
                            }}
                        >
                            {drivers.map(option => (
                                <MenuItem key={option.id} value={option.id}>
                                    {`${option.name} ${option.surname}`}
                                </MenuItem>
                            ))}
                        </Select>
                    </FormControl>
                    <TextField
                        inputProps={{type: "readonly"}}
                        id="outlined-name"
                        label="Driver Passport"
                        name="driver_passport"
                        value={driver.passport_number ? driver.passport_number : ""}
                        className={classes.textField}
                        margin="normal"
                        variant="outlined"
                    />
                    <TextField
                        required
                        inputProps={{type: "hidden"}}
                        InputProps={{disableUnderline: true}}
                        name="document_type"
                        value="invoice"
                    />
                    <TextField
                        required
                        inputProps={{type: "hidden"}}
                        InputProps={{disableUnderline: true}}
                        name="document_format"
                        value="pdf"
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
