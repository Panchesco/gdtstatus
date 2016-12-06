#Good at Statuses

Make status group data available in ExpressionEngine templates.

##Usage

###Tags

```{exp:gdtstatus:unslug}```

Replaces dashes and underscores in tagdata with a whitespace.
####Parameters
| Parameter | Description |Default|Options
| --- | --- | --- | --- |
| slug | The string to act on |  | 
| separator | Character used as separator in slugs | - |

You can also wrap tagdata in an unslug tag pair.

###Tag Pairs

```{exp:gdtstatus:group}```

####Parameters
| Parameter | Description |Default|Options
| --- | --- | --- | --- |
| group_id | The status group ids as pipe delimited list |  | 
| group_name | The status group names as pipe delimited list |  | 
| exclude | The statuses as pipe delimited list | | 
| group_sort | Sort order for Status Group names | ASC | ASC, DESC
| status_sort | Sort order for Statuses using native status_order property | ASC | ASC, DESC
| separator | Character to use as separator in returned slug variable | - |

####Variables
{group_id}<br>
{group_name}<br> 
{status_id}<br>
{status}<br>
{slug}</br>
{status_order}<br>
{highlight}

###Example
```
{exp:gdtstatus:group group_name="Blog" exclude="draft|open|closed"}
{if count==1}<ul>{/if}
	<li><a href="{path="group"}/{slug}">{status}</a></li>
{if count==total_results}</ul>{/if}
{/exp:gdtstatus:group}
```

