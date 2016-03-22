#Good at Statuses

Make status group data available in ExpressionEngine templates.

##About

I'm getting the hang of the new Add-on architecture in EE3. Today it was [Fetching Models](https://docs.expressionengine.com/latest/development/services/model/fetching.html). Here's a simple plugin that fetches a channel status group and let's you output the results in your templates.

##Usage

###Tag Pairs
There's just the one:

```{exp:gdtstatus:group}```

####Parameters
| Parameter | Description |Default|Options
| --- | --- | --- | --- |
| group_id | The status group ids as pipe delimited list |  | 
| group_name | The status group names as pipe delimited list |  | 
| exclude | The statuses as pipe delimited list | | 
| group_sort | Sort order for Status Group names | ASC | ASC, DESC
| status_sort | Sort order for Statuses using native status_order property | ASC | ASC, DESC

####Variables
{group_id}<br>
{group_name}<br> 
{status_id}<br>
{status}<br>
{status_order}<br>
{highlight}

###Example
```
{exp:gdtstatus:group group_name="Blog" exclude="draft|open|closed"}
{if count==1}<ul>{/if}
	<li>{status}</li>
{if count==total_results}</ul>{/if}
{/exp:gdtstatus:group}
```

