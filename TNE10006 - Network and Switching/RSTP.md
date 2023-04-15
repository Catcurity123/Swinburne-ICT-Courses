# RAPID SPANNING TREE PROTOCOL
## Description
There have been several versions of STP released over the years to improve convergence times and add features.

![STP versions](https://github.com/Catcurity123/TNE10006/blob/main/Picture/RSTP/ListSpanningTree.png?raw=true)


## Rapid Spanning Tree Protocol
RSTP works upon a new bridge-bridge handshake mechanism, which allows ports to move directly to forwarding without having to wait 30 secons.

The **similarities of RSTP and STP** are as follows:
- RSTP serves the same purpose as STP, which is to block ports to prevent Layer 2 loops,
- RSTP elects a root bridge with the same rules as STP.
- RSTP elects root ports with the same rules as STP.
- RSTP elects designated ports with the same rules as STP.

**Port cost**, however, is different as follows:

![RSTP port state](https://github.com/Catcurity123/TNE10006/blob/main/Picture/RSTP/SpanningTreeCost.png?raw=true)

**RSTP port states** also simplify the port state of STP.

![RSTP port state](https://github.com/Catcurity123/TNE10006/blob/main/Picture/RSTP/RSTPPortState.png?raw=true)

**The root port** and **designated port** remain unchanged in RSTP, **non-designated** port however is divided into two roles:
- **Althernative port** role is the port that will be blocked and receive BPDU from superior switch

![alternative](https://github.com/Catcurity123/TNE10006/blob/main/Picture/RSTP/Alternative.png?raw=true)

- **back up port** role **only exsist if a Switch is connected to a hub** (which is not so common in modern network), it will function as a back up for the **designated port**.

![backup](https://github.com/Catcurity123/TNE10006/blob/main/Picture/RSTP/Backup.png?raw=true)

Unlike STP which will only allow root bridge to send BPDUs, RSTP send their own BPDUs every hello time (2 seconds), Switch age in RSP also faster with just 3 misses (6 seconds), if after 6 seconds the port will flush all MAC address learned on that interface, assuming that the interface is down.

**RSTP link Type** consists of 3 types:
- **Edge port** is the port that connected to the end host, as there is no risk of creating a loop, it will move directly to forwarding state.
- **Point-to-Point** is the port that connected to another switch, it will operate in full-duplex mode.
- **Shared port** is the port that connected to a Hub (which is not normally seen in modern network), it will operate in half-duplex.

Example of identifying **port role** and **link type**

![example](https://github.com/Catcurity123/TNE10006/blob/main/Picture/RSTP/Example.png?raw=true)