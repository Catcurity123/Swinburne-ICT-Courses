# STP - Spanning Tree Protocol

## Description:
STP stands for Spanning Tree Protocol, which is a network protocol used to prevent loops in a network topology.


### **Network Redundancy**
Redundancy is an essential part of network design. As modern networks are expected to run 24/7/365, even a short downtime can be disastrous for a business.
- Network redundancy implementation must be considered as much as possible at every point in the network so that if one network component fails, other component will take over with little or no downtime.

The following is an example of a poorly designed network


![Point of failure example](https://github.com/Catcurity123/TNE10006/blob/main/Picture/Point_Of_Failure.png?raw=true)


The following is an example of a much better designed network

![Good network](https://github.com/Catcurity123/TNE10006/blob/main/Picture/Good_Network.png?raw=true)


> However, without STP, there is a problem that can destroy our redundant network.

### **Broadcast Storm**
![broadcast storm](https://github.com/Catcurity123/TNE10006/blob/main/Picture/Broadcast_Storm.png?raw=true)


The Ethernet Frame has a TTL field to prevent infinite loops, however, Layer 2 does not have such a field. Therefore, these broadcast storm or the broadcast frames that loops indefinitely around the network will cause our network to be congested and eventually 'destroyed'.

### **Classic Spanning Tree Protocol or IEEE 802.1D**
Switches from ALL vendors run STP by default. It prevents Layer 2 loops by placing redundant ports in a blocking state, essentially disabling the interface. These interfaces then act as backups that can enter a forwarding state if an active interface fails.

Interfaces in a blocking state only send or receive STP messages or BPDUs (Bridge Protocol Data Unit)

Therefore by selecting which ports are **forwarding** or **blocking** STp creates a single path to/from each point in the network and prevent Layer 2 loop.

**THE PROCESS OF STP OCCURS AS FOLLOWS**

**1**. **Root Bridge** Election:
- **STP-enabled switches send/receive Hello BPDUs** out of all interface with the default timer of 2 seconds, if a switch receive a Hello BPDU on an interface, it knows that the interface is connected to another switch (Other devices do not use STP).
- Switches use one field in the STP BPDU, the **Bridge ID** to elect a root bridge for the network. **The switch with the lowest Bridge ID will win**, however, if the bridge priority is equal (it is set to 32768 by default), it will use the **MAC address as a tie-breaker**.


![Bridge ID](https://github.com/Catcurity123/TNE10006/blob/main/Picture/Bridge_ID.png?raw=true)


- Cisco switches use a version of STP called PVST(Per-VLAN SPanning Tree). Therefore, there is a VLAN ID in the Bridge ID to enable different VLAN instances to forwarding or blocking state.

![Bridge Priority and Extended System ID](https://github.com/Catcurity123/TNE10006/blob/main/Picture/Bridge_ID2.png?raw=true)

As the **Bridge priority + Extended system ID** is a single field of the bridge ID and the extended system ID is set(by the VLAN ID) hence can not be changed, we can only change the STP bridge priory in units of 4096. That is:

```
0, 4096, 8192, 12288, 16384, 20480,.....
```
  **1.1** When a switch is powered on, it assumes it is the root bridge and send Hello BPDUs to all other bridge in the network.

  **1.2** Switches will only give up its position if it receives a 'superior' BPDU (with a lower bridge ID).

  **1.3** Once the topology has converged and all switches agree on the root bridge, only the root bridge sends BPDUs.

  **1.4** Other switches in the network will forward BPDUs but will not generate their own original BPDUs.

  **1.5** With all the calculation done, **the root bridge is elected** and all interfaces on the root bridge are designated ports which means that they are in forwarding state.

**2**. Each remaining switch will select **ONE** of its interface to be its **root port**. The interface with **the lowest root cost will be the root port** (root ports are also in a forwarding state).

Root cost is calculated based on the following:
```
10 Mbps => 100 STP cost (Ethernet)
100 Mbps => 19 STP cost (FastEthernet)
1 Gbps => 4 STP cost (Gigabit)
10 Gbps => 2 STP cost
```
![Switch logic of choosing root port](https://github.com/Catcurity123/TNE10006/blob/main/Picture/Logic.png?raw=true)

The root port is selected based on 3 criteria:
- Lowest root cost.
- Lowest neighbor bridge ID. (combination of priority and MAC)
- Lowest neighbor port ID. 

**IT IS CRUCIAL TO REMEMBER THAT THE TWO TIE-BREAKER IS IN THE NEIGHBOR NOT LOCAL**

**3** Each remaining collision domain will select ONE interface to be a designated port and the other port in the collision domain will be non-designated.
- The Switch with the lowest root cost will make its port designated
- If the root cost is the same, the switch with the lower bridge ID will make its port designated.
- The other switch will make its port non-designated (blocking).

### Examples
![STP_Example](https://github.com/Catcurity123/TNE10006/blob/main/Picture/Ex1.png?raw=true)

![Example_answer](https://github.com/Catcurity123/TNE10006/blob/main/Picture/Ex1_Answer.png?raw=true)


### Spanning Tree Port States

There are 4 states of STP port and 2 attributes for those states:

![STP state](https://github.com/Catcurity123/TNE10006/blob/main/Picture/STP/STPState.png?raw=true)

- **Root/Designated** ports remain **stable** in **Forwarding** state.
- **Non-designated** ports remain stable in a **Blocking** state.
- **Listening and Learning** are transitional states which are passed through when an interface is activated, or when a **Blocking** port must transition to a **Forwarding** state.

**NOTE**
- **Transitional state** is the initial state of a port when STP is first enabled or when a topology change occurs. During this state, the port is blocked and does not forward any traffic.
- **Stable state** is the state once the port has determined the root bridge and the best path to the root bridge. In this state, the port is unblocked and begins forwarding traffic.

---
Let's talk more about STP Port State:

* **Blocking**
  * Non-designated ports are in a **Blocking** state.
  * Interfaces in a **Blocking** state are effectively disabled to prevent loops, therefore, it does not send or receive regular network traffic, and only receives STP BPDUs.
  * It does NOT forward STP BPDUs and does NOT learn MAC address.

* **Listenning**
  * After Blocking state, interfaces with the Designated or Root role enter **Listening** state.
  * Only Designated or Root ports enter the Listening state.
  * The Listening state is 15 seconds long by default.
  * Interfaces in the Listening state ONLY forward/receive STP BPDUs, it does NOT send/receive regular traffic and it does NOT learn MAC address.

* **Learning**
   * AFter the listening state, a Designated or Root port will enter the Learning state, which is 15 seconds long by default.
   * The Learning state **LEARNS** MAC address from regular traffic that arrives on the interface.

* **Forwarding**
  * Root and Designated ports are in a Forwarding state if they are stable.
  * A port in the Forwarding state sends/receives BPDUs.
  * A port in the Forwarding state sends/receives normal traffic.
  * A port in the Forwarding state learns MAC address.

![STP port summary](https://github.com/Catcurity123/TNE10006/blob/main/Picture/STP/SummaryPortState.png?raw=true)

### Spanning Tree Timers

![Spanning Tree Timer](https://github.com/Catcurity123/TNE10006/blob/main/Picture/STP/SpanningTreeTimer.png?raw=true)

* Therefore, STP Max Age Timer is crucial for detecting error in network topology and issues appropriate measures to fix the error.

**NOTE**
* If another BPDU is received before the max age timer counts down to 0, the time will reset.
* If another BPDU is not received before timer counts down to 0, the swtich will reevaluate its STP choices, including root bridge, local root, designated port and so on. In order to detect network topology's error.
* If a non-designated port is selected to become a designated or root port to fix the error, it will transition **from the blocking state to the listening state(15 seconds), learning state(15 seconds), and the finally the forwading state**. Meaning that it can take **a total of 50 seconds** for a blocking interface to transition to forwading.

>That would be a huge waste of time and resources, which can be avoided using **PORTFAST**.

### **PORTFAST**
It is noteworthy that only interfaces connected to another switch can form a Layer 2 loop, therefore, there is no point in transitioning from blocking to listening to learning for interface that is connected to **end-user**.

![Interface connected to end-user](https://github.com/Catcurity123/TNE10006/blob/main/Picture/STP/PortFast.png?raw=true)

* Portfast allows a port to move immediately to the **Forwading** state, bypassing **Listening and Learning**.

* If used it must be enabled only on ports connected to end hosts.
* If enable on a port connected to another switch it could cause a Layer 2 loop.


### **STP Load-Balancing**
Different VLANs may have different STP topology for load-balancing, suppose we have the following example:

![Vlan1](https://github.com/Catcurity123/TNE10006/blob/main/Picture/STP/Vlan1.png?raw=true)

![Vlan2](https://github.com/Catcurity123/TNE10006/blob/main/Picture/STP/Vlan2.png?raw=true)

If we have multiple VLANs in our network, blocking the same interface in each VLAN is a waste of interface bandwith, that interface will be doing nothing, just waiting for another connection  to fail so it can start forwarding.

However, if we configure different root bridge for different VLANs, different VLANs will disable different interfaces making the best use of its bandwith. Another example as follows:

![STP load-balancing Ex](https://github.com/Catcurity123/TNE10006/blob/main/Picture/STP/Ex.png?raw=true)


![STP load-balancing Ex2](https://github.com/Catcurity123/TNE10006/blob/main/Picture/STP/Vlan10.png?raw=true)



![STP load-balancing Ex3](https://github.com/Catcurity123/TNE10006/blob/main/Picture/STP/vlan20.png?raw=true)
