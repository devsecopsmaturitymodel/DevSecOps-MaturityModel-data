## DSOMM Activity Dependencies

The activities in this DSOMM Model have the following dependencies.

```mermaid
graph LR

0(L2 Basic data leak prevention)
1(L2 AI usage policy)
2(L4 Automated data leak detection for AI interactions)
3(L4 Hallucination detection for AI responses)
4(L4 Secure output handling in AI applications)
5(L3 Input validation for AI systems)
6(L1 Context-aware output encoding)
7(L5 Protection of agent memory against poisoning)
8(L2 Instructed load of security rules)
9(L1 Static load of security rules)
10(L2 Spec-driven development)
11(L2 Inventory of AI agents)
12(L2 Language and framework specific security rules)
13(L1 Version control)
14(L2 Threat modeling rule)
15(L1 Conduction of simple threat modeling on technical level)
16(L3 Audit logging of AI agent actions)
17(L2 Centralized application logging)
18(L3 Decommissioning of AI agents)
19(L3 Least privilege on external systems for AI agents)
20(L3 Evaluation of the trust of used AI components)
21(L2 Evaluation of the trust of used components)
22(L3 Threat modeling of AI components)
23(L3 Tripwires for AI agent environments)
24(L2 Alerting)
25(L4 Anomaly detection for AI agent behavior)
26(L4 Dynamic load of security rules)
27(L5 Automated containment of anomalous AI agents)
28(L2 Rate limiting and resource budgets for AI systems)
29(L2 Monitoring of costs)
30(L2 Untrusted workspace handling for AI agents)
31(L1 Usage of sandboxing for AI agents)
32(L3 Enforcement of guardrails outside the reach of AI agents)
33(L2 Permission management for AI agents)
34(L3 Block pushes containing secrets)
35(L3 Network isolation for AI agents)
36(L4 Human approval for irreversible AI agent actions)
37(L4 Trust boundaries between AI agents)
38(L2 Human review of AI generated plans)
39(L2 Human review of AI generated specifications)
40(L2 Self-verification of AI generated changes)
41(L1 Defined build process)
42(L2 Security unit tests for important components)
43(L2 Static and dynamic analysis of AI generated code)
44(L3 Static analysis for important server side components)
45(L2 Simple Scan)
46(L2 Validation of AI-suggested dependencies)
47(L2 Software Composition Analysis server side)
48(L3 Human review of AI generated code)
49(L3 No verification bypass for AI generated code)
50(L3 Security test generation with AI)
51(L4 Continuous detection of compromised AI components)
52(L3 Test for compromised components)
53(L5 Drift detection for agent instructions and guardrails)
54(L3 Drift detection for deployed configuration)
55(L2 Building and testing of artifacts in virtualized environments)
56(L2 Usage of containers)
57(L2 Pinning of artifacts)
58(L2 SBOM of components)
59(L3 Signing of code)
60(L5 Signing of artifacts)
61(L1 Automated deployment process)
62(L1 Defined deployment process)
63(L1 Inventory of production components)
64(L2 Inventory of production artifacts)
65(L3 Handover of confidential parameters)
66(L2 Environment depending configuration parameters secrets)
67(L3 Inventory of production dependencies)
68(L3 Rolling update on deployment)
69(L4 Canary deployment)
70(L4 Same artifact for environments)
71(L4 Usage of feature toggles)
72(L5 Blue/Green Deployment)
73(L4 Smoke Test)
74(L2 Automated merge of automated PRs)
75(L1 Automated PRs for patches)
76(L3 Automated deployment of automated PRs)
77(L3 Creation of simple abuse stories)
78(L3 Creation of threat modeling processes and standards)
79(L4 Conduction of advanced threat modeling)
80(L5 Creation of advanced abuse stories)
81(L2 Regular security training of security champions)
82(L2 Each team has a security champion)
83(L2 Determining the protection requirement)
84(L2 App. Hardening Level 1)
85(L1 App. Hardening Level 1 50%)
86(L3 App. Hardening Level 2 75%)
87(L4 App. Hardening Level 2)
88(L5 App. Hardening Level 3)
89(L3 Block force pushes)
90(L2 Require a PR before merging)
91(L1 Test for stored secrets in code)
92(L3 Dismiss stale PR approvals)
93(L3 Require status checks to pass)
94(L2 Central identity provider for human access)
95(L1 Simple access control for systems)
96(L2 Least-privilege access baseline)
97(L2 Account inventory)
98(L2 MFA)
99(L1 MFA for admins)
100(L3 Automated authorization test coverage)
101(L1 Enforce server-side authorization on every request)
102(L3 Automated joiner-mover-leaver provisioning)
103(L3 Fine-Grained Access Controls for authentication and authorization)
104(L3 Use correct OAuth2/OIDC authorization flows)
105(L4 Just-in-time privileged access)
106(L4 Periodic access recertification)
107(L4 Segregation of duties for critical actions)
108(L4 Workload and machine identity)
109(L5 Continuous and risk-adaptive access)
110(L5 Externalized policy-as-code authorization)
111(L2 Backup)
112(L2 Usage of test and production environments)
113(L2 Virtual environments are limited)
114(L3 Immutable infrastructure)
115(L3 Infrastructure as Code)
116(L3 Limitation of system events)
117(L3 Audit of system events)
118(L3 Usage of security by default for components)
119(L3 WAF baseline)
120(L4 Production near environments are used by developers)
121(L4 WAF medium)
122(L5 WAF Advanced)
123(L3 Logging of AI interactions)
124(L3 Visualized logging)
125(L1 Centralized system logging)
126(L5 Correlation of security events)
127(L2 Visualized metrics)
128(L1 Simple application metrics)
129(L1 Simple system metrics)
130(L3 Advanced availability and stability metrics)
131(L3 Deactivation of unused metrics)
132(L3 Targeted alerting)
133(L4 Advanced app. metrics)
134(L4 Coverage and control metrics)
135(L4 Defense metrics)
136(L3 Filter outgoing traffic)
137(L4 Screens with metric visualization)
138(L3 Grouping of metrics)
139(L5 Metrics are combined with tests)
140(L2 Patching mean time to resolution via PR)
141(L3 Generation of response statistics)
142(L3 Usage of a vulnerability management system)
143(L4 Patching mean time to resolution via production)
144(L2 Artifact-based false positive treatment)
145(L1 Simple false positive treatment)
146(L3 Fix based on accessibility)
147(L1 Treatment of defects with high or critical severity)
148(L3 Global false positive treatment)
149(L2 Exploit likelihood estimation)
150(L3 Office Hours)
151(L2 Coverage of client side dynamic components)
152(L2 Usage of different roles)
153(L3 Coverage of hidden endpoints)
154(L3 Coverage of more input vectors)
155(L3 Coverage of sequential operations)
156(L4 Usage of multiple scanners)
157(L5 Coverage of service to service communication)
158(L2 Test for exposed services)
159(L2 Isolated networks for virtual environments)
160(L2 Test network segmentation)
161(L3 Test for unauthorized installation)
162(L2 Test for Time to Patch)
163(L2 Test libyear)
164(L3 API design validation)
165(L3 Software Composition Analysis client side)
166(L3 Static analysis for important client side components)
167(L3 Test for Patch Deployment Time)
168(L4 Static analysis for all self written components)
169(L4 Usage of multiple analyzers)
170(L5 Dead code elimination)
171(L5 Exclusion of source code duplicates)
172(L5 Static analysis for all components/libraries)
173(L4 Correlate known vulnerabilities in infrastructure with new image versions)
174(L2 Usage of a maximum lifetime for images)
175(L4 Test of infrastructure components for known vulnerabilities)


1 --> 0
1 --> 11
1 --> 20
0 --> 2
4 --> 3
5 --> 4
5 --> 7
6 --> 4
6 --> 119
9 --> 8
9 --> 12
9 --> 26
10 --> 8
10 --> 12
10 --> 14
10 --> 26
10 --> 38
10 --> 39
13 --> 10
13 --> 62
15 --> 14
15 --> 22
15 --> 77
15 --> 78
15 --> 79
11 --> 16
11 --> 18
17 --> 16
17 --> 123
17 --> 124
19 --> 18
19 --> 27
19 --> 37
19 --> 48
21 --> 20
21 --> 161
24 --> 23
24 --> 25
24 --> 28
24 --> 17
24 --> 126
24 --> 132
16 --> 25
16 --> 36
16 --> 37
14 --> 26
14 --> 50
8 --> 26
25 --> 27
29 --> 28
31 --> 30
31 --> 35
33 --> 32
33 --> 19
33 --> 36
34 --> 32
39 --> 38
41 --> 40
41 --> 49
41 --> 57
41 --> 58
41 --> 59
41 --> 60
41 --> 61
41 --> 62
41 --> 70
41 --> 118
41 --> 45
41 --> 47
41 --> 163
41 --> 165
41 --> 166
41 --> 44
41 --> 167
41 --> 52
41 --> 170
41 --> 171
42 --> 40
44 --> 43
44 --> 49
44 --> 168
44 --> 172
45 --> 43
45 --> 49
45 --> 152
45 --> 157
47 --> 46
47 --> 149
47 --> 52
47 --> 169
48 --> 50
20 --> 51
52 --> 51
7 --> 53
54 --> 53
56 --> 55
56 --> 113
57 --> 60
62 --> 61
62 --> 111
62 --> 112
61 --> 63
61 --> 64
61 --> 54
61 --> 68
61 --> 69
61 --> 120
61 --> 73
63 --> 64
63 --> 83
63 --> 146
63 --> 47
63 --> 164
63 --> 165
63 --> 166
63 --> 44
63 --> 168
63 --> 172
66 --> 65
64 --> 67
58 --> 67
70 --> 71
73 --> 72
75 --> 74
75 --> 140
75 --> 143
75 --> 162
75 --> 167
74 --> 76
78 --> 77
78 --> 79
77 --> 80
82 --> 81
82 --> 142
85 --> 84
84 --> 86
86 --> 87
87 --> 88
90 --> 89
90 --> 92
90 --> 93
91 --> 34
95 --> 94
95 --> 96
97 --> 96
99 --> 98
99 --> 105
101 --> 100
96 --> 102
96 --> 103
96 --> 105
96 --> 106
96 --> 107
96 --> 108
94 --> 102
94 --> 104
102 --> 106
105 --> 109
103 --> 109
103 --> 110
106 --> 109
115 --> 114
115 --> 120
117 --> 116
119 --> 121
119 --> 122
125 --> 124
124 --> 126
127 --> 24
127 --> 130
127 --> 117
127 --> 131
127 --> 133
127 --> 134
127 --> 135
128 --> 29
128 --> 127
128 --> 130
128 --> 133
129 --> 29
129 --> 127
136 --> 135
138 --> 137
138 --> 139
142 --> 141
142 --> 148
140 --> 143
145 --> 144
147 --> 146
144 --> 148
149 --> 142
149 --> 165
150 --> 142
152 --> 151
152 --> 153
152 --> 154
152 --> 155
152 --> 156
159 --> 158
159 --> 160
166 --> 168
166 --> 172
165 --> 169
168 --> 169
174 --> 173
174 --> 175

O --> 1
O --> 5
O --> 6
O --> 9
O --> 13
O --> 15
O --> 21
O --> 31
O --> 33
O --> 41
O --> 42
O --> 56
O --> 66
O --> 75
O --> 82
O --> 85
O --> 90
O --> 91
O --> 95
O --> 97
O --> 99
O --> 101
O --> 115
O --> 125
O --> 128
O --> 129
O --> 136
O --> 138
O --> 145
O --> 147
O --> 150
O --> 159
O --> 174
```
