YUI.add('gothsoundcloud-editview', function(Y) {
  'use strict';

  Y.namespace('goth');

  const FIELDTYPE_IDENTIFIER = 'goth_soundcloud';
  const URL_SELECTOR = '.goth-soundcloud-url-field-value';

  Y.goth.GothSoundCloudEditView = Y.Base.create('gothSoundCloudEditView', Y.eZ.FieldEditView, [], {
    _variables: function() {
      return {
        isRequired: this.get('fieldDefinition').isRequired
      };
    },

    _getFieldValue: function() {
      var container = this.get('container');

      return {
        url: container.one(URL_SELECTOR).get('value')
      };
    }
  });

  Y.eZ.FieldEditView.registerFieldEditView(
    FIELDTYPE_IDENTIFIER, Y.goth.GothSoundCloudEditView
  );
});