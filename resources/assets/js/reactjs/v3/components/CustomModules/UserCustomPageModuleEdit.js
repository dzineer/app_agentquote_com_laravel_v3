import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import BlockComponent from '../BlockComponent';
import ChevronLeftIcon from "../Icons/ChevronLeftIcon";

/** class UserCustomPageModuleEdit */
class UserCustomPageModuleEdit extends Component {

    constructor(props) {
        super(props);

        this.state = {
            url: this.props.url,
            fields: {
                data: '',
                className: '',
                user_id: 0,
                page_id: 0,
                page_path: '',                
                name: '',   
            },
            checkBoxes: {
                inMenuChecked: false,
                isActiveChecked: false
            }
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

        this.onFieldChange.bind(this);
        this.onCheck.bind(this);
        this.validator.bind(this);
        this.updatePage.bind(this);
        this.getIsChecked.bind(this);
    }

    message = (type, msg) => {
        switch(type) {
            case 'success':
                toastr.success(msg);
                break;
            case 'warn':
                toastr.warn(msg);
                break;
            case 'info':
                toastr.info(msg);
                break;
            case 'error':
                toastr.error(msg);
                break;

            default:
                toastr.info(msg);
        }
    };

    componentDidMount() {
        debugger;
        this.setState({
            customModule: this.props.customModule,
            url: this.props.url,
            moduleData: this.props.moduleData,
            fields: {
                data: this.props.data,
                className: this.props.className,
                user_id: this.props.user_id,
                page_id: this.props.page_id,
                page_path: this.props.page_path,                
                name: this.props.name,                
            },
            checkBoxes: {
                isActiveChecked: this.props.active === 1,
                inMenuChecked: this.props.in_menu === 1
            }

        })
    }

    onFieldChange = (e) => {
      let fields = Object.assign({}, this.state.fields );
      fields[ e.currentTarget.name ] = e.currentTarget.value;
      this.setState({
          fields
      });
    };

    onCheck = (e) => {
      let checkBoxes = Object.assign({}, this.state.checkBoxes);
      checkBoxes[ e.currentTarget.name ] = e.currentTarget.value;
      switch( e.currentTarget.name ) {
          case 'active':
              checkBoxes.isActiveChecked = !this.state.checkBoxes.isActiveChecked;
              break;
          case 'in_menu':
              checkBoxes.inMenuChecked = !this.state.checkBoxes.inMenuChecked;
              break;
          default:
      }

      this.setState({
          checkBoxes
      });
    };

    postWithFileRequest = (url, data, in_headers)=>  {
        debugger;
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let headers = {
            'Accept': 'application/json',
            //    'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token
        };

        let post_headers = Object.assign({}, headers, in_headers);

        return fetch(url,
            {
                method: "POST",
                headers: post_headers,
                credentials: 'same-origin',
                body: data
            })
    };

    validator = () => {
        debugger;
        if (this.state.fields.length) {
            for(let i=0; i < this.state.fields.length; i++) {
                if (this.state.fields[i].length === 0) {
                    let message = this.state.fields[i] + 'cannot be blank.';
                    this.message('error', message);
                    return false;
                }
            }
            return true;
        }
        return true;

    };

    updatePage = (e) => {

        e.preventDefault();

        console.log( this.state.ad );

        let fd = new FormData();
        let code = tinyMCE.activeEditor.getContent();

        if (this.state.fields.name.length === 0) {
            let message = this.state.fields[i] + 'cannot be blank.';
            this.message('error', message);
            return false;
        }

        if (this.state.fields.page_path.length === 0) {
            let message = this.state.fields[i] + 'cannot be blank.';
            this.message('error', message);
            return false;
        }

        debugger;

        let options = {
            "module_id" : this.state.customModule.id,
            "active" : this.state.checkBoxes.isActiveChecked ? '1' : '0',
            "in_menu" : this.state.checkBoxes.inMenuChecked ? '1' : '0',
            "code": code,
            "name": this.state.fields.name,
            "url_path": this.state.fields.page_path,
            "user_id" : this.state.fields.user_id,
            "page_id" : this.state.fields.page_id,
            "class": this.state.fields.className
        };

        fd.append("options", JSON.stringify( options ));
        fd.append("action", "update");

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

    getIsChecked = () => {
      debugger;
      return this.state.checked;
    };

    render() {

        return (

            <div className="row">

                <div className="col-md-12">
                    <a href={"/modules?module=user_custom_pages_module" } class="tw-flex tw-justify-start tw-items-center tw-text-2xl tw-mt-2"><i class="tw-flex tw-justify-center tw-items-center fa fa-icon icon-default fa-angle-left fa-fw tw-text-primary tw-rounded-full tw-border tw-border-primary tw-w-8 tw-h-8 tw-leading-tight tw-text-center"></i> <span class="tw-ml-2">Back</span></a>
                </div>

                <div className="col-md-12">
                    <input type="submit"
                           className="btn btn-primary btn-lg btn-block btn-huge control update-btn mt-3 mb-3"
                           value=" Save " onClick={ this.updatePage } />
                </div>

                <div className="col-md-12">
                    <h4 className="header-sp m-y-20">User Custom Page</h4>
                </div>

                <div className="col-md-12">
                    <div className="form-check mt-10 mb-3">
                        <input type="checkbox" aria-label="Check to enable page" className="form-check-input p-4 p-l-10" id="active" style={{"borderRadius": "0"}} name="active" checked={ this.state.checkBoxes.isActiveChecked } onChange={ this.onCheck } />
                        <span htmlFor="active" className="form-check-label">Enable Page</span>
                    </div>
                </div>

                <div className="col-md-12">
                    <div className="form-check mb-3">
                        <input type="checkbox" aria-label="Check to add as menu item" className="form-check-input p-4 p-l-10" id="in_menu" style={{"borderRadius": "0"}} name="in_menu" checked={ this.state.checkBoxes.inMenuChecked } onChange={ this.onCheck } />
                        <label htmlFor="in_menu" className="form-check-label">Include in Page Menu</label>
                    </div>
                </div>

                <div className="col-md-12">
                    <div className="form-group">
                        <label htmlFor="page-background" className="m-r-10">Page name: </label>
                        <input type="text" className="form-control p-4 p-l-10" id="name" style={{"borderRadius": "0"}} name="name" required={ true } value={ this.state.fields.name } onChange={ this.onFieldChange } />
                    </div>
                </div>

                <div className="col-md-12">
                    <div className="form-group">
                        <label htmlFor="page-background" className="m-r-10">Page path: </label>
                        <input type="text" className="form-control p-4 p-l-10" id="page_path" style={{"borderRadius": "0"}} name="page_path" required={ true } value={ this.state.fields.page_path } onChange={ this.onFieldChange } />
                    </div>
                </div>

                <div className="col-md-12">
                    <div className="form-group">
                        <input type="text" className="form-control p-4" style={{"minHeight":"800px", "borderRadius": "none"}} id="code" name="code" required={ true } value={ this.state.fields.data } />
                    </div>
                </div>

                <div className="col-md-12">
                    <input type="submit"
                           className="btn btn-primary btn-lg btn-block btn-huge control update-btn mt-3 mb-3"
                           value=" Save " onClick={ this.updatePage} />
                </div>

            </div>
        );
    }
};

UserCustomPageModuleEdit.propTypes = {
    customModule: PropTypes.object.isRequired,
    can_notifiy: PropTypes.array,
    notifications: PropTypes.array,
    user_id: PropTypes.number.isRequired,
    page_id: PropTypes.number.isRequired,
    name: PropTypes.string.isRequired,
    page_path: PropTypes.string.isRequired,
    data: PropTypes.string.isRequired,
    className: PropTypes.string,
    in_menu: PropTypes.number.isRequired,
    active: PropTypes.number.isRequired,
    url: PropTypes.string.isRequired,
};

UserCustomPageModuleEdit.defaultProps = {
    customModule: {},
    can_notifiy: [],
    notifications: [],
    user_id: 0,
    page_id: '0',
    name: '',
    page_path: '',
    data: '',
    className: '',
    in_menu: 0,
    active: 0,
    url: ''
};

export default UserCustomPageModuleEdit;

if (document.getElementById('user-customer-page-module-edit')) {
    render(
        <UserCustomPageModuleEdit name={ name } customModule={ customModule } data={ data } url={ url } user_id={ user_id } page_id={ page_id } page_path= { page_path } className={ CSS_Class } in_menu={ in_menu } active={ active }/>,
        document.getElementById('user-customer-page-module-edit')
    );
}
