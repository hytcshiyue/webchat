﻿

#pragma checksum "C:\Users\just\Desktop\ContosoCookbook\ContosoCookbook\HubPage.xaml" "{406ea660-64cf-4c82-b6f0-42d48172a799}" "55687C199DF5E00A7DCD8109B52BDEC3"
//------------------------------------------------------------------------------
// <auto-generated>
//     This code was generated by a tool.
//
//     Changes to this file may cause incorrect behavior and will be lost if
//     the code is regenerated.
// </auto-generated>
//------------------------------------------------------------------------------

namespace ContosoCookbook
{
    partial class HubPage : global::Windows.UI.Xaml.Controls.Page, global::Windows.UI.Xaml.Markup.IComponentConnector
    {
        [global::System.CodeDom.Compiler.GeneratedCodeAttribute("Microsoft.Windows.UI.Xaml.Build.Tasks"," 4.0.0.0")]
        [global::System.Diagnostics.DebuggerNonUserCodeAttribute()]
 
        public void Connect(int connectionId, object target)
        {
            switch(connectionId)
            {
            case 1:
                #line 163 "..\..\HubPage.xaml"
                ((global::Windows.UI.Xaml.Controls.SearchBox)(target)).QuerySubmitted += this.Search_QuerySubmitted;
                 #line default
                 #line hidden
                #line 167 "..\..\HubPage.xaml"
                ((global::Windows.UI.Xaml.Controls.SearchBox)(target)).SuggestionsRequested += this.Search_SuggestionsRequested;
                 #line default
                 #line hidden
                #line 168 "..\..\HubPage.xaml"
                ((global::Windows.UI.Xaml.Controls.SearchBox)(target)).ResultSuggestionChosen += this.Search_ResultSuggestionChosen;
                 #line default
                 #line hidden
                break;
            case 2:
                #line 53 "..\..\HubPage.xaml"
                ((global::Windows.UI.Xaml.Controls.Hub)(target)).SectionHeaderClick += this.Hub_SectionHeaderClick;
                 #line default
                 #line hidden
                break;
            case 3:
                #line 69 "..\..\HubPage.xaml"
                ((global::Windows.UI.Xaml.Controls.TextBlock)(target)).SelectionChanged += this.pageTitle_SelectionChanged;
                 #line default
                 #line hidden
                break;
            case 4:
                #line 123 "..\..\HubPage.xaml"
                ((global::Windows.UI.Xaml.Controls.ListViewBase)(target)).ItemClick += this.ItemView_ItemClick;
                 #line default
                 #line hidden
                break;
            case 5:
                #line 107 "..\..\HubPage.xaml"
                ((global::Windows.UI.Xaml.Controls.ListViewBase)(target)).ItemClick += this.ItemView_GroupClick;
                 #line default
                 #line hidden
                break;
            }
            this._contentLoaded = true;
        }
    }
}

