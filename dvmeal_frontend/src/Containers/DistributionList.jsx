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
        // setLabelWidth(inputLabel.current.offsetWidth);
    }, []);

    useEffect(() => {
    }, []);


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

            </Container>
        </Container>
        </MainCard>
    )
};
