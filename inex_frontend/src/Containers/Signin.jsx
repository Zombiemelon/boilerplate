import React, { useState }  from 'react';
import Avatar from '@material-ui/core/Avatar';
import Button from '@material-ui/core/Button';
import CssBaseline from '@material-ui/core/CssBaseline';
import TextField from '@material-ui/core/TextField';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Checkbox from '@material-ui/core/Checkbox';
import Grid from '@material-ui/core/Grid';
import LockOutlinedIcon from '@material-ui/icons/LockOutlined';
import Typography from '@material-ui/core/Typography';
import { makeStyles } from '@material-ui/core/styles';
import Container from '@material-ui/core/Container';
import Link from '@material-ui/core/Link';
import MainCard, { goUp, goDown } from "../Components/Basic/MainCard";
import axios from '../Components/Axios/Axios';
import { SnackbarProvider, useSnackbar } from 'notistack';

const useStyles = makeStyles(theme => ({
    '@global': {
        body: {
            backgroundColor: theme.palette.common.white,
        },
    },
    paper: {
        marginTop: theme.spacing(8),
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
    },
    avatar: {
        margin: theme.spacing(1),
        backgroundColor: theme.palette.secondary.main,
    },
    form: {
        width: '100%', // Fix IE 11 issue.
        marginTop: theme.spacing(1),
    },
    submit: {
        margin: theme.spacing(3, 0, 2),
    },
}));

export default function SignIn(props) {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [animation, setAnimation] = useState(goDown);
    const classes = useStyles();
    const { enqueueSnackbar } = useSnackbar();

    const login = () => {
        axios.post('api/login', {
                email,
                password
        }).then(function (response) {
            localStorage.setItem('api_token', JSON.stringify(response.data.api_token));
            localStorage.setItem('id', JSON.stringify(response.data.id));
            localStorage.setItem('email', JSON.stringify(response.data.email));
            localStorage.setItem('roles', JSON.stringify(response.data.roles));
            setAnimation(goUp)
        }).catch(function (error) {
            console.log(error.response.data);
            showSnackBar('error',error.response.data);
        });
    };

    const showSnackBar = (variant, message) => {
        enqueueSnackbar(message, { variant });
    };

    return (
        <SnackbarProvider>
        <MainCard history={props.history} animation={animation}>
        <Container maxWidth="sm">
            <CssBaseline />
            <div className={classes.paper}>
                <Avatar className={classes.avatar}>
                    <LockOutlinedIcon />
                </Avatar>
                <Typography component="h1" variant="h5">
                    Sign in
                </Typography>
                <form className={classes.form} noValidate>
                    <TextField
                        variant="outlined"
                        margin="normal"
                        required
                        fullWidth
                        id="email"
                        label="Email Address"
                        name="email"
                        autoComplete="email"
                        autoFocus
                        onBlur={e => {setEmail(e.target.value)}}
                    />
                    <TextField
                        variant="outlined"
                        margin="normal"
                        required
                        fullWidth
                        name="password"
                        label="Password"
                        type="password"
                        id="password"
                        autoComplete="current-password"
                        onBlur={e => {setPassword(e.target.value)}}
                    />
                    <FormControlLabel
                        control={<Checkbox value="remember" color="primary" />}
                        label="Remember me"
                    />
                    <Button
                        fullWidth
                        variant="contained"
                        color="primary"
                        className={classes.submit}
                        onClick={login}
                    >
                        Sign In
                    </Button>
                    <Grid container>
                        <Grid item xs>
                            <Link href="#" variant="body2">
                                Forgot password?
                            </Link>
                        </Grid>
                        <Grid item>
                            <Link onClick={() => {props.history.push("/signup")}} variant="body2">
                                {"Don't have an account? Sign Up"}
                            </Link>
                        </Grid>
                    </Grid>
                </form>
            </div>
        </Container>
        </MainCard>
        </SnackbarProvider>
    );
}