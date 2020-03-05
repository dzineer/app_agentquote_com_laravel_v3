import React, {Component} from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import CarrierForm from './CarrierForm';
import * as categoryActions from '../../actions/categoryActions';
import toastr from 'toastr';

class CarrierPage extends Component {
    constructor(props) {
        super(props);

        this.state = {
            errors: [],
            categories: []
        };
        this.onClick = this.onClick.bind(this);
    }

    onClick = event => {
        toastr.success("clicked");
    };

    componentDidMount() {
        let newState = Object.assign({}, this.state, { categories: this.props.categories });
        this.setState(newState);
        this.setState(newState);
    }

    render() {
        // // debugger;
        return (
            <div>
                <br /><br />

                <CarrierForm errors={this.state.errors} onClick={this.onClick} categories={this.props.categories} />
            </div>
        );
    }
}

CarrierPage.propTypes = {
    //actions: PropTypes.object,
  //  categories: PropTypes.object
};

const mapStateToProps = (state, ownProps) => {
    return {
        categories: state.categories
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        actions: bindActionCreators(categoryActions, dispatch)
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(CarrierPage);