
# DTP and VTP



## Description:
A VLAN (Virtual Local Area Network) is a logical, virtual network within a physical network infrastructure.


### **DTP - Dynamic Trunking Protocol**
DTP is CISCO proprietary protocol that allows Cisco switches to dynamically determine their interface status (access or trunk) without manual configuration
- It is enabled by default on all Cisco switch interfaces.
- For security purposes, manual configuration is recommended and DTP should be disabled on all switchport.

There are 2 modes regarding DTP:
- **Dynamic Desirable** will actively try to form a trunk with other Cisco switches. It will form a trunk **if the connected switchport is in trunk or dynamic mode**.
- **Dynamic Auto** will not actively try to form a trunk with other Cisco switches. It will ,however, form a trunk **if the connected switchport is in trunk or dynamic desirable mode**.

- To enable Dynamic trunking, use the following:
  - **switchport mode dynamic desirable**
  - **switchport mode dynamic auto**
- To disable DTP negotiation, use the following:
  - **switchport nonegotiate**

![DTP mode chart](https://github.com/Catcurity123/TNE10006/blob/main/Picture/DTP/DTPChart.png?raw=true)

### **VTP - VLAN Trunking Protocol**
VTP allows for VLANs configuration on a central VTP server switch, and other switches will synchronize their VLAN database on the server. It is designed for large networks with many VLANs, so it is rarely used and is recommended to not use it.

There are 3 VTP modes: **server, client** and **transparent**.

- **VTP Server** can perform the following tasks:
  - Add/modify/delete VLANs
  - Store the VLAN database in non-volatile RAM.
  - Increase the revision number every time a VLAN is added/modified/deleted.
  - Will advertise the latest version of the VLAN database on trunk interfaces, and the VTP clients will synchronize their VLAN database to it.
  - VTP servers also function as VTP clients.

- **VTP Client** can perform the following tasks:
  - Synchronize their VLAN database to the server with the highest revision number in their VTP domain

- **VTP Transparent mode** operate individually as it does not participate in the VTP domain.
