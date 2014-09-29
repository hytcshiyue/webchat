﻿using ContosoCookbook.Common;
using ContosoCookbook.Data;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Runtime.InteropServices.WindowsRuntime;
using Windows.Foundation;
using Windows.Foundation.Collections;
using Windows.UI.Xaml;
using Windows.UI.Xaml.Controls;
using Windows.UI.Xaml.Controls.Primitives;
using Windows.UI.Xaml.Data;
using Windows.UI.Xaml.Input;
using Windows.UI.Xaml.Media;
using Windows.UI.Xaml.Navigation;

//“中心页”项模板在 http://go.microsoft.com/fwlink/?LinkID=321224 上有介绍

namespace ContosoCookbook
{
    /// <summary>
    /// 显示分组的项集合的页。
    /// </summary>
    public sealed partial class HubPage : Page
    {
        private NavigationHelper navigationHelper;
        private ObservableDictionary defaultViewModel = new ObservableDictionary();

        /// <summary>
        /// NavigationHelper 在每页上用于协助导航和
        /// 进程生命期管理
        /// </summary>
        public NavigationHelper NavigationHelper
        {
            get { return this.navigationHelper; }
        }

        /// <summary>
        /// 可将其更改为强类型视图模型。
        /// </summary>
        public ObservableDictionary DefaultViewModel
        {
            get { return this.defaultViewModel; }
        }

        public HubPage()
        {
            this.InitializeComponent();
            this.navigationHelper = new NavigationHelper(this);
            this.navigationHelper.LoadState += navigationHelper_LoadState;
        }

        /// <summary>
        /// 使用在导航过程中传递的内容填充页。  在从以前的会话
        /// 重新创建页时，也会提供任何已保存状态。
        /// </summary>
        /// <param name="sender">
        /// 事件的来源; 通常为 <see cref="NavigationHelper"/>
        /// </param>
        /// <param name="e">事件数据，其中既提供在最初请求此页时传递给
        /// <see cref="Frame.Navigate(Type, Object)"/> 的导航参数，又提供
        /// 此页在以前会话期间保留的状态的
        /// 字典。 首次访问页面时，该状态将为 null。</param>
        private async void navigationHelper_LoadState(object sender, LoadStateEventArgs e)
        {
            // Featured recipe
            var favorites = await SampleDataSource.GetFavoriteRecipesAsync(1);
            this.DefaultViewModel["Section1Item"] = favorites.SingleOrDefault();

            // International Cuisine
            var groups = await SampleDataSource.GetGroupsAsync();
            this.DefaultViewModel["Section2Items"] = groups;

            // Top rated
            var topRated = await SampleDataSource.GetTopRatedRecipesAsync(6);
            this.DefaultViewModel["Section3Items"] = topRated;

            this.DefaultViewModel["ZoomedOutList"] = this.GetSectionList();
        }
        
        /// <summary>
        /// 在单击 HubSection 标题时调用。
        /// </summary>
        /// <param name="sender">包含单击了其标题的 HubSection 的中心。</param>
        /// <param name="e">描述如何启动单击的事件数据。</param>
        void Hub_SectionHeaderClick(object sender, HubSectionHeaderClickEventArgs e)
        {
            HubSection section = e.Section;
            var group = section.DataContext;
            this.Frame.Navigate(typeof(SectionPage), ((SampleDataGroup)group).UniqueId);
        }

        /// <summary>
        /// 在单击节内的项时调用。
        /// </summary>
        /// <param name="sender">GridView 或 ListView
        /// 为 ListView)。</param>
        /// <param name="e">描述所单击项的事件数据。</param>
        void ItemView_ItemClick(object sender, ItemClickEventArgs e)
        {
            // 导航至相应的目标页，并
            // 通过将所需信息作为导航参数传入来配置新页
            var itemId = ((SampleDataItem)e.ClickedItem).UniqueId;
            this.Frame.Navigate(typeof(ItemPage), itemId);
        }
        #region NavigationHelper 注册

        /// 此部分中提供的方法只是用于使
        /// NavigationHelper 可响应页面的导航方法。
        /// 
        /// 应将页面特有的逻辑放入用于
        /// <see cref="GridCS.Common.NavigationHelper.LoadState"/>
        /// 和 <see cref="GridCS.Common.NavigationHelper.SaveState"/> 的事件处理程序中。
        /// 除了在会话期间保留的页面状态之外
        /// LoadState 方法中还提供导航参数。

        protected override void OnNavigatedTo(NavigationEventArgs e)
        {
            navigationHelper.OnNavigatedTo(e);
        }

        protected override void OnNavigatedFrom(NavigationEventArgs e)
        {
            navigationHelper.OnNavigatedFrom(e);
        }

        #endregion

        private void pageTitle_SelectionChanged(object sender, RoutedEventArgs e)
        {

        }
        private void Search_QuerySubmitted(SearchBox sender, SearchBoxQuerySubmittedEventArgs args)
        {
            var queryText = args.QueryText;
            this.Frame.Navigate(typeof(SearchResultsPage), queryText);
        }
        void ItemView_GroupClick(object sender, ItemClickEventArgs e)
        {
            // Navigate to the appropriate destination page, configuring the new page
            // by passing required information as a navigation parameter
            var itemId = ((SampleDataGroup)e.ClickedItem).UniqueId;
            this.Frame.Navigate(typeof(SectionPage), itemId);
        }
        private IEnumerable<string> GetSectionList()
        {
            var sections = this.Hub.Sections;
            var headers = new List<string>();

            foreach (var item in sections)
            {
                var section = (HubSection)item;
                var header = (string)section.Header;
                if (string.IsNullOrWhiteSpace(header))
                {
                    continue;
                }

                yield return header;
            }
        }

        private void Search_SuggestionsRequested(SearchBox sender, SearchBoxSuggestionsRequestedEventArgs args)
        {
            string queryText = args.QueryText;
            if (!string.IsNullOrWhiteSpace(queryText))
            {
                var suggestionCollection = args.Request.SearchSuggestionCollection;

                // result suggestions
                var searchResults = SampleDataSource.Search(queryText, true);
                foreach (var result in searchResults.SelectMany(p => p.Items).Take(2))
                {
                    var imageUri = new Uri("ms-appx:///" + result.TileImagePath);
                    var imageSource = Windows.Storage.Streams.RandomAccessStreamReference.CreateFromUri(imageUri);
                    suggestionCollection.AppendResultSuggestion(result.Title, result.Description, result.UniqueId, imageSource, result.Description);
                }

                // separator
                suggestionCollection.AppendSearchSeparator("Suggestions");

                // query suggestions
                string[] suggestionList =
        {
            "小雪", "小暑", "立春", "立秋", "立夏", "小寒", "立冬", "大暑", "大寒"
        };

                foreach (string suggestion in suggestionList)
                {
                    if (suggestion.StartsWith(queryText, StringComparison.CurrentCultureIgnoreCase))
                    {
                        suggestionCollection.AppendQuerySuggestion(suggestion);
                    }
                }
            }
        }

        private void Search_ResultSuggestionChosen(SearchBox sender, SearchBoxResultSuggestionChosenEventArgs args)
        {
            var itemId = args.Tag;
            this.Frame.Navigate(typeof(ItemPage), itemId);
        }
    }
   
}
