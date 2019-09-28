import React, { useState, useEffect }  from 'react';
import styled from 'styled-components';
import { makeStyles } from '@material-ui/core/styles';
import TextField from '@material-ui/core/TextField';
import Button from "@material-ui/core/Button";
import Container from "@material-ui/core/Container";
import MenuItem from "@material-ui/core/MenuItem";
import Select from "@material-ui/core/Select";
import FormControl from "@material-ui/core/FormControl";
import InputLabel from "@material-ui/core/InputLabel";
import axios from "../Components/Axios/Axios";
import {Box} from "@material-ui/core";
import Avatar from "@material-ui/core/Avatar";
import Reorder from '@material-ui/icons/Reorder';
import { useSnackbar } from 'notistack';
import CircularProgress from "@material-ui/core/CircularProgress";
import MainCard, { goDown } from "../Components/Basic/MainCard";

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
    button: {
        background: 'rgba(34,193,195,1)',
        color: 'white',
        border: '2px',
        borderRadius: 3,
        height: 48,
        padding: '0 30px',
        margin: theme.spacing(1)
    },
    innerContainer: {
        position: 'relative',
        background: 'white',
        border: 0,
        borderRadius: 3,
        color: 'white',
        padding: '30px',
    },
    bigAvatar: {
        margin: 10,
        width: 60,
        height: 60,
        backgroundColor: 'rgba(34,193,195,1)'
    }
}));

const StyledDiv = styled.div`
    background-color: black;
    opacity: 0.8;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 2;
    ${props => `opacity: ${props.opacity}`}
    ${props => props.width ? `width: ${props.width};` : 'width: 0;'}
    ${props => props.width ? `height: ${props.width};` : 'height: 0;'}
    transition: opacity 2s ease, height 2s ease 2s, width 2s ease 2s;
`;

const ProgressDiv = styled.div`
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: ${props => props.display ? props.display : 'none;'}
`;

export default function distributionList (props) {
    const { enqueueSnackbar } = useSnackbar();
    const classes = useStyles();
    const [drivers, setDrivers] = useState([]);
    const [driver, setDriver] = useState([]);
    const [truck, setTruck] = useState([]);
    const [trucks, setTrucks] = useState([]);
    const [documentNumber, setDocumentNumber] = useState(0);
    const [dateForLoading, setDateForLoading] = useState('23-24/08/2019');
    const [styles, setStyles] = useState({
        width: 0,
        height: 0,
        opacity: 0
    });
    const [animation, setAnimation] = useState(goDown);
    const [loadingStyle, setLoadingStyle] = useState({display: 'none'});
    const inputLabel = React.useRef(null);
    const [labelWidth, setLabelWidth] = useState(0);
    useEffect(() => {
        setLabelWidth(inputLabel.current.offsetWidth);
    }, []);

    useEffect(() => {
        getDrivers();
        getTrucks();
        getLastDocumentNumber();
    }, []);

    const openSnackbar = (message, option) => {
        enqueueSnackbar(message, {variant: option});
    };

    const getDrivers = () => {
        axios.get('/api/drivers').then(response =>  {
            setDrivers(response.data);
        });
    };

    const getTrucks = () => {
        showLoading();
        axios.get('/api/trucks').then(response =>  {
            setTrucks(response.data);
            hideLoading();
        }).catch(()=>{
            hideLoading();
        });
    };

    const getLastDocumentNumber = () => {
        axios.get('/api/last_document_number', {
            params: {
                document_type: 'distribution_list',
                document_format: 'pdf'
            }
        }).then(response =>  {
            console.log(response.data);
            setDocumentNumber(response.data+1);
        });
    };

    const getDocument = (deliveryMethod) => {
        showLoading();
        axios.get('/api/document', {
            params: {
                document_type: 'distribution_list',
                document_format: 'pdf',
                delivery_method: deliveryMethod,
                number: documentNumber,
                dateForLoading: dateForLoading,
                truckNumber: truck.plate_number,
                driver: `${driver.name} ${driver.surname}`,
                driverPassport: driver.passport_number
            },
            //Required for file download
            responseType: 'arraybuffer',
            headers: {
                'Content-Type': 'application/json'
            },
        }).then(response =>  {
            hideLoading();
            //Required for file download
            if(deliveryMethod === 'download')
            {
                const type = response.headers['content-type'];
                const blob = new Blob([response.data], { type: type, encoding: 'UTF-8' });
                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = `distribution_list_${documentNumber}.pdf`;
                link.click();
            }
            getLastDocumentNumber();
            setDriver('');
            setTruck('')
        }).catch(error => {
            hideLoading();
            if(error.response.status === 400) {
                const message = 'Please check the data. Something is wrong.';
                openSnackbar(message, 'error');
            }
        })
    };

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
    };

    const hideLoading = () => {
        setLoadingStyle({display: 'none'})
    };

    const showLoading = () => {
        setLoadingStyle({display: 'inline-block'})
    };

    return (
        <MainCard history={props.history} animation={animation}>
        <Container maxWidth="sm">
            <Container maxWidth="sm" className={classes.innerContainer}>
            <ProgressDiv display={loadingStyle.display}>
                <CircularProgress color="secondary"/>
            </ProgressDiv>
            <StyledDiv width={styles.width} opacity={styles.opacity} height={styles.height} />
            <Box display="flex" justifyContent="center">
                <Avatar className={classes.bigAvatar}>
                    <Reorder className={classes.icon}/>
                </Avatar>
            </Box>
            <form noValidate autoComplete="off">
                <div className={classes.container}>
                    <TextField
                        id="outlined-name"
                        label="Number"
                        name="number"
                        value={documentNumber}
                        onChange={(e) => setDocumentNumber(e.target.value)}
                        className={classes.textField}
                        margin="normal"
                        variant="outlined"
                    />
                    <TextField
                        id="outlined-name"
                        label="Date of loading"
                        name="date_of_loading"
                        value={dateForLoading}
                        onChange={e => setDateForLoading(e.target.value)}
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
                    <Button
                        variant="outlined"
                        className={classes.button}
                        type="submit"
                        onClick={(e) =>{e.preventDefault(); getDocument('download')}}>
                        Download
                    </Button>
                    <Button
                        variant="outlined"
                        className={classes.button}
                        type="submit"
                        onClick={(e) =>{e.preventDefault(); getDocument('email')}}>
                        Send email
                    </Button>
                </div>
            </form>
            </Container>
        </Container>
        </MainCard>
    )
};
