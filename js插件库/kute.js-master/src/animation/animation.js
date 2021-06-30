import supportedProperties from '../objects/supportedProperties.js';
import defaultValues from '../objects/defaultValues.js';
import defaultOptions from '../objects/defaultOptions.js';
import prepareProperty from '../objects/prepareProperty.js';
import prepareStart from '../objects/prepareStart.js';
import onStart from '../objects/onStart.js';
import onComplete from '../objects/onComplete.js';
import crossCheck from '../objects/crossCheck.js';
import linkProperty from '../objects/linkProperty.js';
import Util from '../objects/util.js';
import Interpolate from '../objects/interpolate.js';

// Animation class
// * builds KUTE components
// * populate KUTE objects
// * AnimatonBase creates a KUTE.js build for pre-made Tween objects
// * AnimatonDevelopment can help you debug your new components
export default class Animation {
  constructor(Component) {
    try {
      if (Component.component in supportedProperties) {
        throw Error(`KUTE.js - ${Component.component} already registered`);
      } else if (Component.property in defaultValues) {
        throw Error(`KUTE.js - ${Component.property} already registered`);
      } else {
        this.setComponent(Component);
      }
    } catch (e) {
      throw Error(e);
    }
  }

  setComponent(Component) {
    const propertyInfo = this;
    const ComponentName = Component.component;
    // const Objects = { defaultValues, defaultOptions, Interpolate, linkProperty, Util }
    const Functions = {
      prepareProperty, prepareStart, onStart, onComplete, crossCheck,
    };
    const Category = Component.category;
    const Property = Component.property;
    const Length = (Component.properties && Component.properties.length)
      || (Component.subProperties && Component.subProperties.length);

    // single property
    // {property,defaultvalue,defaultOptions,Interpolate,functions}

    // category colors, boxModel, borderRadius
    // {category,properties,defaultvalues,defaultOptions,Interpolate,functions}

    // property with multiple sub properties. Eg transform, filter
    // {property,subProperties,defaultvalues,defaultOptions,Interpolate,functions}

    // property with multiple sub properties. Eg htmlAttributes
    // {category,subProperties,defaultvalues,defaultOptions,Interpolate,functions}

    // set supported category/property
    supportedProperties[ComponentName] = Component.properties
      || Component.subProperties || Component.property;

    // set defaultValues
    if ('defaultValue' in Component) { // value 0 will invalidate
      defaultValues[Property] = Component.defaultValue;

      // minimal info
      propertyInfo.supports = `${Property} property`;
    } else if (Component.defaultValues) {
      Object.keys(Component.defaultValues).forEach((dv) => {
        defaultValues[dv] = Component.defaultValues[dv];
      });

      // minimal info
      propertyInfo.supports = `${Length || Property} ${Property || Category} properties`;
    }

    // set additional options
    if (Component.defaultOptions) {
      Object.keys(Component.defaultOptions).forEach((op) => {
        defaultOptions[op] = Component.defaultOptions[op];
      });
    }

    // set functions
    if (Component.functions) {
      Object.keys(Functions).forEach((fn) => {
        if (fn in Component.functions) {
          if (typeof (Component.functions[fn]) === 'function') {
            // if (!Functions[fn][ Category||Property ]) {
            //   Functions[fn][ Category||Property ] = Component.functions[fn];
            // }
            if (!Functions[fn][ComponentName]) Functions[fn][ComponentName] = {};
            if (!Functions[fn][ComponentName][Category || Property]) {
              Functions[fn][ComponentName][Category || Property] = Component.functions[fn];
            }
          } else {
            Object.keys(Component.functions[fn]).forEach((ofn) => {
              // !Functions[fn][ofn] && (Functions[fn][ofn] = Component.functions[fn][ofn])
              if (!Functions[fn][ComponentName]) Functions[fn][ComponentName] = {};
              if (!Functions[fn][ComponentName][ofn]) {
                Functions[fn][ComponentName][ofn] = Component.functions[fn][ofn];
              }
            });
          }
        }
      });
    }

    // set component interpolate
    if (Component.Interpolate) {
      Object.keys(Component.Interpolate).forEach((fni) => {
        const compIntObj = Component.Interpolate[fni];
        if (typeof (compIntObj) === 'function' && !Interpolate[fni]) {
          Interpolate[fni] = compIntObj;
        } else {
          Object.keys(compIntObj).forEach((sfn) => {
            if (typeof (compIntObj[sfn]) === 'function' && !Interpolate[fni]) {
              Interpolate[fni] = compIntObj[sfn];
            }
          });
        }
      });

      linkProperty[ComponentName] = Component.Interpolate;
    }

    // set component util
    if (Component.Util) {
      Object.keys(Component.Util).forEach((fnu) => {
        if (!Util[fnu]) Util[fnu] = Component.Util[fnu];
      });
    }

    return propertyInfo;
  }
}
