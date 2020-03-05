import React, {Component} from 'react';
import PropTypes from 'prop-types';
import ContentForm from "../common/ContentForm";
import BannerContainer from "./BannerContainer";

class BannerPage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            errors: []
        };
    }

    render() {
        // // debugger;
        return (
            <BannerContainer />
        );
    }
}

BannerPage.propTypes = {

};

export default BannerPage;