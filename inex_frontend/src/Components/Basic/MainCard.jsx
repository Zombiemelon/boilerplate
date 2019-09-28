import styled, {keyframes, css} from 'styled-components';
import React from "react";

export const goUp = keyframes`
      0% {
        top: 0;
        top: 50%;
        left: 50%;
      }
      100% {
        top: -100%;
      }
`;

export const goDown = keyframes`
      0% {
        top: -100%;
      }
      100% {
        top: 0;
        top: 50%;
        left: 50%;
      }
`;

export const animation = css`
    animation-name: ${props => props.animation};
    animation-timing-function: ease-in-out;
    animation-duration: 0.7s
`;

export const MainCardDiv = styled.div`
    ${animation};
    max-height: 90%;
    width: 60%;
    max-width: 600px;
    position: absolute;
    top: ${props => props.top};
    left: 50%;
    transform: translate(-50%, -50%);
    transition: all 2s ease;
    border-radius: 5px;
    background-color: white;
    padding: 30px;
`;


const MainCard = (props) => {
    let top = '50%';
    if(props.animation === goUp) {
        top = '-100%';
        setTimeout(() => props.history.push("/"), 700);
    }
    return <MainCardDiv animation={props.animation} top={top}>{props.children}</MainCardDiv>
};

export default MainCard;

