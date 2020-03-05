import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';

/** class NewPageSectionButton */
class NewPageSectionButton extends Component {

    constructor(props) {
        super(props);

        this.state = {
            url: this.props.url,
            fields: {
                file: null
            },
            page_id: 0
        };

        this.fieldErrors = {
            body: "Please provide Ad Text."
        };

        toastr.options = {
            "debug": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 21000
        };

        this.addPageSection.bind(this);
    }

    componentDidMount() {
        debugger;
        this.setState({
            customModule: this.props.customModule,
            url: this.props.url,
            moduleData: this.props.moduleData,
            page_id: this.props.page_id
        })
    }

    addPageSection = (e) => {

        e.preventDefault();

        console.log( this.state.ad );

        let fd = new FormData();

        let options = {
            "module_id" : this.state.customModule.id,
            "page_id" : this.state.page_id,
            "section_id" : 'new'
        };

        fd.append("options", JSON.stringify( options ));
        fd.append("action", "update");

        let in_headers = {};

        axios.post(url, fd).then( res => {
            console.log(res);
            debugger;
            if (res.data.success === true) {
                toastr.success(res.data.message);
            } else {
                toastr.error(res.data.message);
            }
        });


    };

    getInnerHTML = (data) => {
        return data;
    };

    validate = () => {

        return true;

        /*if (this.state.ad.company_id === 0) {
            this.message("error", "Please select your preferred carrier.");
            return false;
        } else */
        if (this.state.ad.body.length === 0 && ! this.refs.file.value.length) {
            this.message("error", "Please provide text to your ad.");
            return false;
        }

        return true;
    };

    render() {

        return (

            <a className="btn btn-secondary m-y-20">+ New Section</a>

        );
    }
}

NewPageSectionButton.propTypes = {
    customModule: PropTypes.object.isRequired,
    page_id: PropTypes.string.isRequired,
    url: PropTypes.string.isRequired,
};

NewPageSectionButton.defaultProps = {
    customModule: {},
    page_id: '0',
    url: ''
};

export default NewPageSectionButton;

if (document.getElementById('page-section-add-btn')) {
    render(
        <NewPageSectionButton customModule={ customModule } url={ url } page_id={ page_id } />,
        document.getElementById('page-section-add-btn')
    );
}
