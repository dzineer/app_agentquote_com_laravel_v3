import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import BlockComponent from '../BlockComponent';
import SwitchFieldToggle from "../Toggles/SwitchFieldToggle";
import ChevronLeftIcon from "../Icons/ChevronLeftIcon";

/** class PageSectionModuleEdit */
class PageSectionModuleEdit extends Component {

    constructor(props) {
        super(props);

        this.state = {
            url: this.props.url,
            fields: {
                section: '',
                data: '',
                className: ''
            },
            page_id: 0,
            section_id: 0,
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
        this.updatePageSection.bind(this);
        this.getIsChecked.bind(this);
        this.genBackups.bind(this);
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
                section: this.props.section,
                data: this.props.data,
                className: this.props.className
            },
            page_id: this.props.page_id,
            section_id: this.props.section_id,
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

    updatePageSection = (e) => {

        e.preventDefault();

        console.log( this.state.ad );

        // if (!this.validate()) {
        //     return;
        // }

        let fd = new FormData();
        let code = tinyMCE.activeEditor.getContent();

        if (this.state.fields.section.length === 0) {
            let message = this.state.fields[i] + 'cannot be blank.';
            this.message('error', message);
            return false;
        }

        debugger;

        let options = {
            "module_id" : this.state.customModule.id,
            "section" : this.state.fields.section,
            "active" : this.state.checkBoxes.isActiveChecked ? '1' : '0',
            "in_menu" : this.state.checkBoxes.inMenuChecked ? '1' : '0',
            "code": code,
            "page_id" : this.state.page_id,
            "section_id" : this.state.section_id,
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

    genBackups = () => {
      return (
          <div className="col-md-12 m-y-20">
              <h5>Backups</h5>
              <div className="row">
                  <div className="col-lg-2 col-md-3 col-sm-4 col-xs-12 m-b-4" style={{"height":"150px"}}>
                      <div className="card" style={{"width": "100%","marginRight": "10px"}}>
                          <div className="card-body">
                              <h5 className="card-title" style={{"textAlign":"center"}}>10/2/2019</h5>
                              <p className="card-subtitle mb-2 text-muted" style={{"textAlign":"center"}}>Version 1</p>
                              <p className="card-text" style={{"textAlign":"center"}}>
                                  <a href="#" className="card-link" >Restore</a>
                              </p>

                          </div>
                      </div>
                  </div>
                  <div className="col-lg-2 col-md-3 col-sm-4 col-xs-12 m-b-4" style={{"height":"150px"}}>
                      <div className="card" style={{"width": "100%","marginRight": "10px"}}>
                          <div className="card-body">
                              <h5 className="card-title" style={{"textAlign":"center"}}>10/2/2019</h5>
                              <p className="card-subtitle mb-2 text-muted" style={{"textAlign":"center"}}>Version 2</p>
                              <p className="card-text" style={{"textAlign":"center"}}>
                                  <a href="#" className="card-link" >Restore</a>
                              </p>

                          </div>
                      </div>
                  </div>
                  <div className="col-lg-2 col-md-3 col-sm-4 col-xs-12 m-b-4" style={{"height":"150px"}}>
                      <div className="card" style={{"width": "100%","marginRight": "10px"}}>
                          <div className="card-body">
                              <h5 className="card-title" style={{"textAlign":"center"}}>10/2/2019</h5>
                              <p className="card-subtitle mb-2 text-muted" style={{"textAlign":"center"}}>Version 3</p>
                              <p className="card-text" style={{"textAlign":"center"}}>
                                  <a href="#" className="card-link" >Restore</a>
                              </p>

                          </div>
                      </div>
                  </div>
                  <div className="col-lg-2 col-md-3 col-sm-4 col-xs-12 m-b-4" style={{"height":"150px"}}>
                      <div className="card" style={{"width": "100%","marginRight": "10px"}}>
                          <div className="card-body">
                              <h5 className="card-title" style={{"textAlign":"center"}}>10/2/2019</h5>
                              <p className="card-subtitle mb-2 text-muted" style={{"textAlign":"center"}}>Version 4</p>
                              <p className="card-text" style={{"textAlign":"center"}}>
                                  <a href="#" className="card-link" >Restore</a>
                              </p>

                          </div>
                      </div>
                  </div>
                  <div className="col-lg-2 col-md-3 col-sm-4 col-xs-12 m-b-4" style={{"height":"150px"}}>
                      <div className="card" style={{"width": "100%","marginRight": "10px"}}>
                          <div className="card-body">
                              <h5 className="card-title" style={{"textAlign":"center"}}>10/2/2019</h5>
                              <p className="card-subtitle mb-2 text-muted" style={{"textAlign":"center"}}>Version 5</p>
                              <p className="card-text" style={{"textAlign":"center"}}>
                                  <a href="#" className="card-link" >Restore</a>
                              </p>

                          </div>
                      </div>
                  </div>
                  <div className="col-lg-2 col-md-3 col-sm-4 col-xs-12 m-b-4" style={{"height":"150px"}}>
                      <div className="card" style={{"width": "100%","marginRight": "10px"}}>
                          <div className="card-body">
                              <h5 className="card-title" style={{"textAlign":"center"}}>10/2/2019</h5>
                              <p className="card-subtitle mb-2 text-muted" style={{"textAlign":"center"}}>Version 6</p>
                              <p className="card-text" style={{"textAlign":"center"}}>
                                  <a href="#" className="card-link" >Restore</a>
                              </p>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
      );
    };

    render() {

        return (

            <div className="row">

                <div className="col-md-12">
                    <a href={"/modules?module=pages_module&page_id=" + this.state.page_id } className="btn btn-secondary btn-lg btn-huge control update-btn mt-3 mb-3"
                       > <ChevronLeftIcon /> Page Sections </a>
                </div>

                <div className="col-md-12">
                    <input type="submit"
                           className="btn btn-primary btn-lg btn-block btn-huge control update-btn mt-3 mb-3"
                           value=" Save " onClick={ this.updatePageSection } />
                </div>

                <div className="col-md-12">
                    <h4 className="header-sp m-y-20">Page Section Module</h4>
                </div>

                <div className="col-md-12">
                    <div className="form-check mt-10 mb-3">
                        <input type="checkbox" aria-label="Check to enable section" className="form-check-input p-4 p-l-10" id="active" style={{"borderRadius": "0"}} name="active" checked={ this.state.checkBoxes.isActiveChecked } onChange={ this.onCheck } />
                        <span htmlFor="active" className="form-check-label">Enable Section</span>
                    </div>
                </div>

                <div className="col-md-12">
                    <div className="form-check mb-3">
                        <input type="checkbox" aria-label="Check to add as menu item" className="form-check-input p-4 p-l-10" id="in_menu" style={{"borderRadius": "0"}} name="in_menu" checked={ this.state.checkBoxes.inMenuChecked } onChange={ this.onCheck } />
                        <label htmlFor="in_menu" className="form-check-label">Include Section in Page Menu</label>
                    </div>
                </div>

                <div className="col-md-12">
                    <div className="form-group">
                        <label htmlFor="section-background" className="m-r-10">Section name: </label>
                        <input type="text" className="form-control p-4 p-l-10" id="section" style={{"borderRadius": "0"}} name="section" required={ true } value={ this.state.fields.section } onChange={ this.onFieldChange } />
                    </div>
                </div>

{/*                <div className="col-md-12">
                    <div className="form-group">
                        Section name will be displayed as: { this.state.fields.section.charAt(0).toUpperCase() + this.state.fields.section.slice(1) }
                    </div>
                </div>*/}



                <div className="col-md-12">
                    <div className="form-group">
                        <label htmlFor="section-background" className="m-r-10">Section background color: </label>
                        <select id="className" name="className" className="form-control" defaultValue={ this.state.fields.className } onChange={ this.onFieldChange } >
                            <option value="bg-alabaster">Gray</option>
                            <option value="white">White</option>
                            <option value="bg-primary">Background Primary</option>
                        </select>
                    </div>
                </div>

                <div className="col-md-12">
                    <div className="form-group">
                        <input type="text" className="form-control p-4" style={{"minHeight":"800px", "borderRadius": "none"}} id="code" name="code" required={ true } value={ this.state.fields.data } />
                    </div>
                </div>

{/*                <div className="col-md-12">
                    <div className="form-group">
                        <BlockComponent />
                    </div>
                </div>*/}

                <div className="col-md-12">
                    <input type="submit"
                           className="btn btn-primary btn-lg btn-block btn-huge control update-btn mt-3 mb-3"
                           value=" Save " onClick={ this.updatePageSection} />
                </div>

            </div>
        );
    }
}

PageSectionModuleEdit.propTypes = {
    customModule: PropTypes.object.isRequired,
    page_id: PropTypes.string.isRequired,
    section_id: PropTypes.string.isRequired,
    section: PropTypes.array.isRequired,
    data: PropTypes.string.isRequired,
    className: PropTypes.string,
    in_menu: PropTypes.number.isRequired,
    active: PropTypes.number.isRequired,
    url: PropTypes.string.isRequired,
};

PageSectionModuleEdit.defaultProps = {
    customModule: {},
    page_id: '0',
    section_id: '0',
    section: '',
    data: '',
    className: '',
    in_menu: 0,
    active: 0,
    url: ''
};

export default PageSectionModuleEdit;

if (document.getElementById('page-section-module-edit')) {
    render(
        <PageSectionModuleEdit data={ moduleData } section={ section } customModule={ customModule } url={ url } page_id={ page_id } section_id={ section_id } className={ CSS_Class } in_menu={ in_menu } active={ active }/>,
        document.getElementById('page-section-module-edit')
    );
}
